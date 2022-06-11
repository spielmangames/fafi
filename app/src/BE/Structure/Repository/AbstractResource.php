<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\db\DatabaseConnector;
use FAFI\db\QueryBuilder;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;

class AbstractResource
{
    public const ID_FIELD = 'id';


    public const E_ENTITY_CREATE_FAILED = 'Failed to create the item.';
    public const E_ENTITY_READ_FAILED = 'Failed to read the item.';
    public const E_ENTITY_UPDATE_FAILED = 'Failed to update the item.';
    public const E_ENTITY_DELETE_FAILED = 'Failed to delete the item.';


    protected EntityValidator $entityValidator;
    protected DatabaseConnector $dbConnect;
    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->entityValidator = new EntityValidator();
        $this->dbConnect = new DatabaseConnector();
        $this->queryBuilder = new QueryBuilder();
    }


    /**
     * @param string $table
     * @param array $data
     *
     * @return int
     * @throws FafiException
     */
    protected function insertRecord(string $table, array $data): int
    {
        $query = $this->queryBuilder->insert($table, $data);
        $query = $this->queryBuilder->close($query);

        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(self::E_ENTITY_CREATE_FAILED . EOL . $connect->error);
            }

            $id = $connect->insert_id;
            if (!$id) {
                throw new FafiException(self::E_ENTITY_CREATE_FAILED . EOL . $connect->error);
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
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return array
     * @throws FafiException
     */
    protected function selectRecords(string $table, array $conditions): array
    {
        $query = $this->queryBuilder->select($table, $conditions);
        $query = $this->queryBuilder->close($query);

        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(self::E_ENTITY_READ_FAILED . EOL . $connect->error);
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
     * @param string $query
     *
     * @return void
     * @throws FafiException
     */
    protected function updateRecord(string $query): void
    {
        $connect = $this->dbConnect->open();

        $connect->begin_transaction();
        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(self::E_ENTITY_UPDATE_FAILED . EOL . $connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnect->close();

            throw $e;
        }
        $connect->commit();

        $this->dbConnect->close();
    }


    /**
     * @param string $table
     * @param string $entityName
     * @param array $entityData
     * @param string $property
     *
     * @return void
     * @throws FafiException
     */
    protected function assertResourcePropertyUnique(string $table, string $entityName, array $entityData, string $property): void
    {
        $condition = new Criteria($property, QueryBuilder::OPERATOR_IS, [$entityData[$property]]);
        $query = $this->queryBuilder->select($table, [$condition]);
        $query = $this->queryBuilder->close($query);
        $result = $this->selectRecords($query);

        if ($result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_NOT_UNIQUE, $entityName, $property));
        }
    }
}
