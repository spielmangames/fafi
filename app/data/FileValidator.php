<?php

declare(strict_types=1);

namespace FAFI\data;

use FAFI\exception\FafiException;
use FAFI\exception\FileErr;

class FileValidator
{
    private const BYTES_IN_MEGABYTE = 1048576;


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function validateFileAccessible(string $filePath): void
    {
        if (!isFileValid($filePath)) {
            throw new FafiException(sprintf(FileErr::FILE_INVALID, $filePath));
        }
    }

    /**
     * @param string $filePath
     * @param string $expectedExt
     *
     * @return void
     * @throws FafiException
     */
    public function validateFileExtension(string $filePath, string $expectedExt): void
    {
        if ('.' . getExt($filePath) !== $expectedExt) {
            throw new FafiException(sprintf(FileErr::FILE_EXT_INVALID, $filePath));
        }
    }

    /**
     * @param string $filePath
     * @param int|null $maxSize
     *
     * @return void
     * @throws FafiException
     */
    public function validateFileSize(string $filePath, ?int $maxSize = null): void
    {
        if (isset($maxSize) && filesize($filePath) > ($maxSize * self::BYTES_IN_MEGABYTE)) {
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
