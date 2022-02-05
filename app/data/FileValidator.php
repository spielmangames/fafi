<?php

namespace FAFI\data;

use FAFI\exception\FafiException;

class FileValidator
{
    private const E_FILE_INVALID = 'File "%s" is invalid.';
    private const E_FILE_EXT_INVALID = 'File "%s" has unsupported extension.';
    private const E_FILE_TOO_LARGE = 'File "%s" is too large.';

    private const E_FILE_DATA_ABSENT = 'No content data had been extracted from "%s".';


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
            throw new FafiException(sprintf(self::E_FILE_INVALID, $filePath));
        }

        if ('.' . getExt($filePath) !== $expectedExt) {
            throw new FafiException(sprintf(self::E_FILE_EXT_INVALID, $filePath));
        }

        if (isset($limit) && filesize($filePath) > $limit) {
            throw new FafiException(sprintf(self::E_FILE_TOO_LARGE, $filePath));
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
            throw new FafiException(sprintf(self::E_FILE_DATA_ABSENT, $filePath));
        }
    }
}
