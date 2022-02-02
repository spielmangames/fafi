<?php

namespace FAFI\entity\Install;

use FAFI\data\FileValidator;
use FAFI\db\DatabaseConnection;
use FAFI\entity\ImEx\ImExService;
use FAFI\exception\FafiException;

class InstallService
{
    public const IMEX_SAMPLE_DIR_PATH = PATH_DATA . 'sample' . DS;
    public const SAMPLE_POSITIONS = 'positions';


    private DatabaseConnection $dbConnection;
    private ImExService $imExService;
    private FileValidator $fileValidator;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
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
        if (!execSqlFile($filePath, $this->dbConnection->open(false))) {
            throw new FafiException(sprintf('Failed to execute "%s".', $fileName));
        }
    }


    /** @throws FafiException */
    public function installSampleData()
    {
        $filePath = self::IMEX_SAMPLE_DIR_PATH . self::SAMPLE_POSITIONS . ImExService::FILE_EXT;
        $this->imExService->importPositions($filePath);
    }
}
