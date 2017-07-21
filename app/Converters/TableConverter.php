<?php

namespace WTG\Converters;

/**
 * Table converter interface.
 *
 * @package     WTG\Converters
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface TableConverter
{
    /**
     * Run the converter.
     *
     * @param  string  $filePath
     * @param  string  $fileType
     * @return bool
     */
    public function run(string $filePath, string $fileType): bool;

    /**
     * Check if the file exists.
     *
     * @return bool
     */
    public function fileExists(): bool;

    /**
     * Read file contents.
     *
     * @param  string  $fileType
     * @return void
     * @throws \Exception
     */
    public function readFileContents(string $fileType);

    /**
     * Parse the file contents.
     *
     * @param  string  $fileType
     */
    public function parseFileContents(string $fileType);

    /**
     * Parse json file contents.
     *
     * @return void
     */
    public function parseJsonContents();

    /**
     * Create a new entity.
     *
     * @param  array  $data
     * @return object
     */
    public function createEntity(array $data);
}