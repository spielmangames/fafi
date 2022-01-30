<?php

namespace FAFI\entity\Import;

use Exception;
use FAFI\entity\Position\Position;
use FAFI\entity\Position\Repository\PositionHydrator;
use FAFI\entity\Position\Repository\PositionRepository;
use FAFI\exception\FafiException;

class ImportService
{
    public const IMEX_DIR_PATH = PATH_APP . 'data' . DS;
    public const IMEX_DIR_PATH_SAMPLE = self::IMEX_DIR_PATH . 'sample' . DS;

    public const IM_FILE_LIMIT = 1048576;
    private const E_FILE_INVALID = 'File %s is invalid.';
    private const E_FILE_TOO_LARGE = 'File %s is too large.';
    private const E_FILE_EMPTY = 'File %s is empty.';


    private function import(string $filePath, string $entity)
    {

    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function importPositions(string $filePath): void
    {
        $filePath = self::IMEX_DIR_PATH_SAMPLE . $filePath;
        $extracted = $this->extract($filePath);
        $transformed = $this->transform($extracted);
        $this->load($transformed);

        $zzz = 1;
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

        try {
            $extracted = parseCsvTable($filePath);
        } catch (Exception $e) {
            throw new FafiException($e->getMessage());
        }

        if (empty($extracted)) {
           throw new FafiException(sprintf(self::E_FILE_EMPTY, $filePath));
        }

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
        if (!isFileValid($filePath)) {
            throw new FafiException(sprintf(self::E_FILE_INVALID, $filePath));
        }

        if (filesize($filePath) > self::IM_FILE_LIMIT) {
            throw new FafiException(sprintf(self::E_FILE_TOO_LARGE, $filePath));
        }
    }

    public function transform(array $data): array
    {
        $hydrator = new PositionHydrator();

        $transformed = [];
        foreach ($data as $row) {
            $entity = $hydrator->hydrate($row);
            $transformed[] = $entity;
        }

        return $transformed;
    }

    /**
     * @param Position[] $data
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $data): void
    {
        $repo = new PositionRepository();

        foreach ($data as $entity) {
            $repo->save($entity);
        }
    }
}
