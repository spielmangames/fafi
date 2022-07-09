<?php

namespace FAFI\data;

use FAFI\exception\FafiException;
use FAFI\exception\FileErr;

class FileValidator
{
    /**
     * @param string $filePath
     * @param string $expectedExt
     * @param int|null $limit
     *
     * @return void
     * @throws FafiException
     */
    public function validateFile(string $filePath, string $expectedExt, ?int $limit = null): void
    {
        if (!isFileValid($filePath)) {
            throw new FafiException(sprintf(FileErr::FILE_INVALID, $filePath));
        }

        if ('.' . getExt($filePath) !== $expectedExt) {
            throw new FafiException(sprintf(FileErr::FILE_EXT_INVALID, $filePath));
        }

        if (isset($limit) && filesize($filePath) > $limit) {
            throw new FafiException(sprintf(FileErr::FILE_TOO_LARGE, $filePath));
        }
    }

    /**
     * @param string $filePath
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    public function validateFileContentPresent(string $filePath, array $data): void
    {
        if (empty($data)) {
            throw new FafiException(sprintf(FileErr::FILE_DATA_ABSENT, $filePath));
        }
    }
}
