<?php

declare(strict_types=1);

namespace FAFI\src\BE\Install;

use FAFI\exception\FafiException;
use FAFI\exception\FileErr;
use FAFI\src\BE\DB\DatabaseConnector;
use FAFI\src\BE\FileStorage\FileValidator;

class DatabaseInstaller
{
    private const DB_FILES_DIR_PATH = PATH_APP . 'src' . DS . 'BE' . DS . 'Install' . DS;
    private const DB_SCHEMA_FILE_NAME = 'fafibase_schema.sql';
    private const DB_DROP_PLAYERS_FILE_NAME = 'drop_players_data.sql';

    private const DB_FILE_EXT = '.sql';
    private const DB_FILE_SIZE_MAX = 1;


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
        $filePath = self::DB_FILES_DIR_PATH . self::DB_SCHEMA_FILE_NAME;
        $this->validateFile($filePath);
        $this->execute($filePath);
    }

    /**
     * @return void
     * @throws FafiException
     */
    public function dropDbPlayersData(): void
    {
        $filePath = self::DB_FILES_DIR_PATH . self::DB_DROP_PLAYERS_FILE_NAME;
        $this->validateFile($filePath);
        $this->execute($filePath);
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
        $this->fileValidator->validateFileExtension($filePath, self::DB_FILE_EXT);
        $this->fileValidator->validateFileSize($filePath, self::DB_FILE_SIZE_MAX);
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
