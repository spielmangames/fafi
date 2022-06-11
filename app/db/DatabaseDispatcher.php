<?php

namespace FAFI\db;

use FAFI\exception\FafiException;

class DatabaseDispatcher
{
    protected DatabaseConnector $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DatabaseConnector();
    }


    /**
     * @param string $query
     *
     * @return void
     * @throws FafiException
     */
    public function write(string $query): void
    {
        $connect = $this->dbConnector->open();
        $connect->begin_transaction();

        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(FafiException::E_ENTITY_OPERATION_FAILED . EOL . $connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->close();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->close();
    }

    /**
     * @param string $query
     *
     * @return array
     * @throws FafiException
     */
    public function read(string $query): array
    {
        $connect = $this->dbConnector->open();
        $connect->begin_transaction();

        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(FafiException::E_ENTITY_OPERATION_FAILED . EOL . $connect->error);
            }

            $selection = [];
            while ($row = $result->fetch_assoc()) {
                $selection[] = $row;
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->close();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->close();

        return $selection;
    }

    public function writeRead(string $query): int
    {
        $connect = $this->dbConnector->open();
        $connect->begin_transaction();

        try {
            $result = $connect->query($query);
            if (!$result) {
                throw new FafiException(FafiException::E_ENTITY_OPERATION_FAILED . EOL . $connect->error);
            }

            $id = $connect->insert_id;
            if (!$id) {
                throw new FafiException(FafiException::E_ENTITY_OPERATION_FAILED . EOL . $connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->close();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->close();
    }
}
