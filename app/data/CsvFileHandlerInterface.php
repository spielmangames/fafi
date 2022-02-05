<?php

namespace FAFI\data;

use FAFI\exception\FafiException;

interface CsvFileHandlerInterface
{
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
     *
     * @return string[][]
     * @throws FafiException
     */
    public function read(string $filePath): array;
}
