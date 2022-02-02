<?php

namespace FAFI\entity\ImEx\Entity;

use Exception;
use FAFI\entity\ImEx\ImExService;
use FAFI\exception\FafiException;

abstract class AbstractEntityImport
{
    private const IM_FILE_LIMIT = 1048576;

    private const E_FILE_EXT_INVALID = 'File "%s" has unsupported extension.';
    private const E_FILE_INVALID = 'File "%s" is invalid.';
    private const E_FILE_TOO_LARGE = 'File "%s" is too large.';
    private const E_FILE_DATA_ABSENT = 'File "%s" has no content data.';


    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    public function extract(string $filePath): array
    {
        $this->validateFileIsReadyForImport($filePath);

        try {
            $extracted = parseCsvTable($filePath);
        } catch (Exception $e) {
            throw new FafiException($e->getMessage());
        }

        $this->validateFileContentPresent($filePath, $extracted);

        return $extracted;
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function validateFileIsReadyForImport(string $filePath): void
    {
        if (!isFileValid($filePath)) {
            throw new FafiException(sprintf(self::E_FILE_INVALID, $filePath));
        }

        if ('.' . getExt($filePath) !== ImExService::FILE_EXT) {
            throw new FafiException(sprintf(self::E_FILE_EXT_INVALID, $filePath));
        }

        if (filesize($filePath) > self::IM_FILE_LIMIT) {
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
    private function validateFileContentPresent(string $filePath, array $data): void
    {
        if (empty($data)) {
            throw new FafiException(sprintf(self::E_FILE_DATA_ABSENT, $filePath));
        }
    }
}
