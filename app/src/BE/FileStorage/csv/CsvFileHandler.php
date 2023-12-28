<?php

declare(strict_types=1);

namespace FAFI\src\BE\FileStorage\csv;

use Exception;
use FAFI\exception\FafiException;
use FAFI\exception\FileErr;

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
            throw new FafiException(FileErr::FILE_OPERATE_FAILED . EOL . $e->getMessage());
        }

        return $content;
    }
}
