<?php

namespace FAFI\data;

use FAFI\exception\FafiException;

interface CsvFileHandlerInterface
{
    public const FILE_EXT = '.csv';
    public const FILE_LENGTH_LIMIT = 1000;


    /**
     * @param string $filePath
     * @param string[][] $content
     *
     * @return void
     * @throws FafiException
     */
    public function write(string $filePath, array $content): void;

    /**
     * @param string $filePath
     * @param int $limit
     *
     * @return string[][]
     * @throws FafiException
     */
    public function read(string $filePath, int $limit = self::FILE_LENGTH_LIMIT): array;
}
