<?php

namespace FAFI\data;

use Exception;
use FAFI\exception\FafiException;

class CsvFileHandler implements CsvFileHandlerInterface
{
    public function write(string $filePath, array $content): void
    {
        // TODO: Implement write() method.
    }

    public function read(string $filePath): array
    {
        try {
            $content = parseCsvTable($filePath);
        } catch (Exception $e) {
            throw new FafiException($e->getMessage());
        }

        return $content;
    }
}
