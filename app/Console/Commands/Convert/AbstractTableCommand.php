<?php

namespace WTG\Console\Commands\Convert;

use Illuminate\Console\Command;
use WTG\Converters\TableConverter;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;

/**
 * Abstract table command.
 *
 * @package     WTG\Console
 * @subpackage  Commands\Convert
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
abstract class AbstractTableCommand extends Command
{
    /**
     * @var TableConverter
     */
    protected $converter;

    /**
     * @var array
     */
    protected $formats = [
        "json",
        "csv"
    ];

    /**
     * Create a new command instance.
     *
     * @param  TableConverter  $converter
     */
    public function __construct(TableConverter $converter)
    {
        parent::__construct();

        $this->converter = $converter;

        $this->addOption('file', 'f', InputOption::VALUE_REQUIRED, 'Name of the file in storage/app');
        $this->addOption('format', 'F', InputOption::VALUE_REQUIRED, 'Determine the source file format (json or csv)', 'csv');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->option('file');
        $format = $this->option('format');
        $filePath = storage_path("app/$file");

        if (! File::exists($filePath)) {
            $this->output->error("File '$filePath' not found.");

            return 1;
        }

        if (! in_array($format, $this->formats)) {
            $this->output->error("Unknown data format '$format'");

            return 1;
        }

        $success = $this->converter->run($file, $format);

        if ($success) {
            $this->output->success("Conversion completed");

            return 0;
        } else {
            $this->output->error("Conversion failed");

            return 1;
        }
    }
}