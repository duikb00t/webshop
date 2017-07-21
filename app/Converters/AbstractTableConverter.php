<?php

namespace WTG\Converters;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Abstract table converter.
 *
 * @package     WTG\Converters
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
abstract class AbstractTableConverter implements TableConverter
{
    const FILE_TYPE_JSON = 'json';
    const FILE_TYPE_CSV = 'csv';

    /**
     * @var Collection
     */
    protected $fileContents;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var array
     */
    protected $csvFields = [];

    /**
     * AbstractTableConverter constructor.
     *
     * @param  EntityManagerInterface  $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Run the converter
     *
     * @param  string  $file
     * @param  string  $fileType
     * @return bool
     */
    public function run(string $file, string $fileType): bool
    {
        $this->filePath = storage_path("app/$file");

        if (!$this->fileExists()) {
            return false;
        }

        $this->readFileContents($fileType);

        $this->parseFileContents($fileType);

        return true;
    }

    /**
     * Check if the file exists.
     *
     * @return bool
     */
    public function fileExists(): bool
    {
        return File::exists($this->filePath);
    }

    /**
     * Read file contents.
     *
     * @param  string  $fileType
     * @return void
     * @throws \Exception
     */
    public function readFileContents(string $fileType)
    {
        if ($fileType === static::FILE_TYPE_JSON) {
            $this->fileContents = collect(
                json_decode(
                    file_get_contents($this->filePath),
                    true
                )
            );
        } elseif ($fileType === static::FILE_TYPE_CSV) {
            $lines = [];

            $file = fopen($this->filePath, "r");

            while (($data = fgetcsv($file, 1)) !== FALSE) {
                $lines[] = $data;
            }
            fclose($file);

            $this->fileContents = collect($lines);
        } else {
            throw new \Exception("Unknown file type '$fileType'");
        }
    }

    /**
     * Parse the file contents.
     *
     * @param  string  $fileType
     * @return void
     * @throws \Exception
     */
    public function parseFileContents(string $fileType)
    {
        if ($fileType === static::FILE_TYPE_JSON) {
            $this->parseJsonContents();
        } elseif ($fileType === static::FILE_TYPE_CSV) {
            $this->parseCsvContents();
        } else {
            throw new \Exception("No handler for filetype '$fileType'");
        }
    }

    /**
     * Parse json file contents.
     *
     * @return void
     */
    public function parseJsonContents()
    {
        $this->fileContents->each(function ($item) {
            $this->em->persist(
                $this->createEntity($item)
            );
        });

        $this->em->flush();
    }

    /**
     * Parse csv file contents.
     *
     * @return void
     */
    public function parseCsvContents()
    {
        $this->fileContents->each(function ($item) {
            $this->em->persist(
                $this->createEntity($this->mapCsvFields($item))
            );
        });

        $this->em->flush();
    }

    /**
     * Create a new entity.
     *
     * @param  array  $data
     * @return object
     */
    public abstract function createEntity(array $data);

    /**
     * Map the csv fields.
     *
     * @param  array  $data
     * @return array
     */
    public function mapCsvFields(array $data)
    {
        foreach ($data as $index => $value) {
            $data[$this->csvFields[$index]] = $value;

            unset($data[$index]);
        }

        return $data;
    }
}