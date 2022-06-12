<?php

namespace FAFI\src\BE\Install;

use FAFI\data\FileValidator;
use FAFI\db\DatabaseConnector;
use FAFI\exception\FafiException;
use FAFI\exception\FileErr;
use FAFI\src\BE\ImEx\ImExService;

class InstallService
{
    public const IMEX_SAMPLE_DIR_PATH = PATH_STORAGE . 'sample' . DS;


    private DatabaseConnector $dbConnect;
    private ImExService $imExService;
    private FileValidator $fileValidator;

    public function __construct()
    {
        $this->dbConnect = new DatabaseConnector();
        $this->imExService = new ImExService();
        $this->fileValidator = new FileValidator();
    }


    /**
     * @return void
     * @throws FafiException
     */
    public function installDbSchema(): void
    {
        $fileName = 'fafibase_schema.sql';
        $filePath = PATH_APP . 'db' . DS . $fileName;

        $this->fileValidator->validateFile($filePath, '.sql');
        if (!execSqlFile($filePath, $this->dbConnect->open(false))) {
            throw new FafiException(sprintf(FileErr::FILE_EXEC_FAILED, $fileName));
        }
    }

    /**
     * @return void
     * @throws FafiException
     */
    public function installSampleData(): void
    {
        $this->importEntity(ImExService::ENTITIES_COUNTRIES);
        $this->importEntity(ImExService::ENTITIES_POSITIONS);
        $this->importEntity(ImExService::ENTITIES_PLAYERS);
    }

    /**
     * @param string $entityName
     *
     * @return void
     * @throws FafiException
     */
    private function importEntity(string $entityName): void
    {
        $filePath = self::IMEX_SAMPLE_DIR_PATH . $entityName . ImExService::FILE_EXT;
        $this->imExService->importEntity($filePath, $entityName);
    }
}
