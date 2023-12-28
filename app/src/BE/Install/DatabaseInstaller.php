<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\data\FileValidator;
use FAFI\exception\FafiException;
use FAFI\exception\FileErr;
use FAFI\src\BE\DB\DatabaseConnector;

class DatabaseInstaller
{
    private const DB_SCHEMA_FILE_NAME = 'fafibase_schema';
    private const DB_SCHEMA_FILE_EXT = '.sql';
    private const DB_SCHEMA_FILE_SIZE_MAX = 1;


    private DatabaseConnector $dbConnect;
    private FileValidator $fileValidator;

    public function __construct()
    {
        $this->dbConnect = new DatabaseConnector();
        $this->fileValidator = new FileValidator();
    }


    /**
     * @return void
     * @throws FafiException
     */
    public function installDbSchema(): void
    {
        $filePath = $this->formSchemaFilePath();
        $this->validateFile($filePath);
        $this->execute($filePath);
    }

    private function formSchemaFilePath(): string
    {
        return PATH_APP . 'db' . DS . self::DB_SCHEMA_FILE_NAME . self::DB_SCHEMA_FILE_EXT;
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function validateFile(string $filePath): void
    {
        $this->fileValidator->validateFileAccessibility($filePath);
        $this->fileValidator->validateFileExtension($filePath, self::DB_SCHEMA_FILE_EXT);
        $this->fileValidator->validateFileSize($filePath, self::DB_SCHEMA_FILE_SIZE_MAX);
    }

    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    private function execute(string $filePath): void
    {
        if (!execSqlFile($filePath, $this->dbConnect->open(false))) {
            throw new FafiException(sprintf(FileErr::FILE_EXEC_FAILED, $filePath));
        }
        sleep(1);
    }
}
