<?php

namespace FAFI\entity\ImEx\Entity;

use Exception;
use FAFI\data\FileValidator;
use FAFI\entity\ImEx\ImExService;
use FAFI\exception\FafiException;

abstract class AbstractEntityImport
{
    private const IM_FILE_LIMIT = 1048576;

    private const E_FILE_DATA_ABSENT = 'No content data had been extracted from "%s".';


    private FileValidator $fileValidator;

    public function __construct()
    {
        $this->fileValidator = new FileValidator();
    }


    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    public function extract(string $filePath): array
    {
        $this->fileValidator->validateFile($filePath, ImExService::FILE_EXT, self::IM_FILE_LIMIT);

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
