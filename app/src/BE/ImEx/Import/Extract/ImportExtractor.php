<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Extract;

use FAFI\data\CsvFileHandler;
use FAFI\data\FileValidator;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\ImExService;

class ImportExtractor
{
    private const IMPORT_FILE_SIZE_MAX = 4;


    private FileValidator $fileValidator;
    private CsvFileHandler $fileHandler;

    public function __construct()
    {
        $this->fileValidator = new FileValidator();
        $this->fileHandler = new CsvFileHandler();
    }


    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    public function extract(string $filePath): array
    {
        $this->validateFile($filePath);
        $extracted = $this->fileHandler->read($filePath);
        $this->fileValidator->validateFileContentPresent($filePath, $extracted);

        return $extracted;
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function validateFile(string $filePath): void
    {
        $this->fileValidator->validateFileAccessible($filePath);
        $this->fileValidator->validateFileExtension($filePath, ImExService::FILE_EXT);
        $this->fileValidator->validateFileSize($filePath, self::IMPORT_FILE_SIZE_MAX);
    }
}
