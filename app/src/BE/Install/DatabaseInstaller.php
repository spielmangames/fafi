<?php

namespace FAFI\src\BE\Install;

use FAFI\data\FileValidator;
use FAFI\db\DatabaseConnector;
use FAFI\exception\FafiException;
use FAFI\exception\FileErr;

class DatabaseInstaller
{
    private const DB_SCHEMA_FILE_NAME = 'fafibase_schema.sql';


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
        $fileName = self::DB_SCHEMA_FILE_NAME;
        $filePath = PATH_APP . 'db' . DS . $fileName;

        $this->fileValidator->validateFile($filePath, '.sql');
        if (!execSqlFile($filePath, $this->dbConnect->open(false))) {
            throw new FafiException(sprintf(FileErr::FILE_EXEC_FAILED, $fileName));
        }
        sleep(1);
    }
}
