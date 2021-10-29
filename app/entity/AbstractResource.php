<?php

namespace FAFI\entity;

use FAFI\db\DatabaseConnection;
use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;

class AbstractResource
{
    // profile basic
    public const ID_FIELD = 'id';


    protected DatabaseConnection $dbConnection;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->dbConnection = new DatabaseConnection();
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

        $connect = $this->dbConnection->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf('Failed to create %s item.', $table) . "\n" . $connect->error);
            }

            $id = $connect->insert_id;
            if (!$id) {
                throw new FafiException(sprintf('Failed to create %s item.', $table));
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnection->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnection->close();

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

        $connect = $this->dbConnection->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf('Failed to read %s items.', $table) . "\n" . $connect->error);
            }

            $selection = [];
            while ($row = $result->fetch_assoc()) {
                $selection[] = $row;
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnection->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnection->close();

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

        $connect = $this->dbConnection->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(sprintf('Failed to update %s item.', $table) . "\n" . $connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnection->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnection->close();
    }
}
