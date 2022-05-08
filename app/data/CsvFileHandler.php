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

    public function read(string $filePath, int $limit = self::FILE_LENGTH_LIMIT): array
    {
        try {
            $content = parseCsvTable($filePath, $limit);
        } catch (Exception $e) {
            throw new FafiException($e->getMessage());
        }

        return $content;
    }
}
