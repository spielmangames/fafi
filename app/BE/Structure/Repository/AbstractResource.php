<?php

namespace FAFI\BE\Structure\Repository;

use FAFI\db\DatabaseConnector;
use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;

class AbstractResource
{
    public const ID_FIELD = 'id';


    public const E_ID_PRESENT = '"id" must be absent for creating %s.';
    public const E_ID_ABSENT = 'ID is required for updating %s and can not be null.';
    public const E_ENTITY_ABSENT = '%s (id = %d) is absent in storage.';

    public const E_ENTITY_CREATE_FAILED = 'Failed to create %s item.';
    public const E_ENTITY_READ_FAILED = 'Failed to read %s item.';
    public const E_ENTITY_UPDATE_FAILED = 'Failed to update %s item.';
    public const E_ENTITY_DELETE_FAILED = 'Failed to delete %s item.';


    protected DatabaseConnector $dbConnect;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->dbConnect = new DatabaseConnector();
        $this->queryBuilder = new QueryBuilder();
    }


    /**
     * @param string $table
     * @param array $data
     * @return int
     * @throws FafiException
     */
    protected function insertRecord(string $table, array $data): int
    {
        $query = $this->queryBuilder->formInsert($table, array_filter($data));

        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf(self::E_ENTITY_CREATE_FAILED, $table) . "\n" . $connect->error);
            }

            $id = $connect->insert_id;
            if (!$id) {
                throw new FafiException(sprintf(self::E_ENTITY_CREATE_FAILED, $table));
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnect->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnect->close();

        return $id;
    }

    /**
     * @param string $table
     * @param EntityCriteriaInterface $criteria
     * @return array
     * @throws FafiException
     */
    protected function selectRecords(string $table, EntityCriteriaInterface $criteria): array
    {
        $query = $this->queryBuilder->formSelect($table, $criteria);

        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf(self::E_ENTITY_READ_FAILED, $table) . "\n" . $connect->error);
            }

            $selection = [];
            while ($row = $result->fetch_assoc()) {
                $selection[] = $row;
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnect->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnect->close();

        return $selection;
    }

    /**
     * @param string $table
     * @param array $data
     * @param EntityCriteriaInterface $criteria
     * @return void
     * @throws FafiException
     */
    protected function updateRecord(string $table, array $data, EntityCriteriaInterface $criteria): void
    {
        $query = $this->queryBuilder->formUpdate($table, array_filter($data), $criteria);

        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf(self::E_ENTITY_UPDATE_FAILED, $table) . "\n" . $connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnect->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnect->close();
    }
}
