<?php

declare(strict_types=1);

namespace FAFI\db;

use FAFI\exception\DbErr;
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
                $this->fail($connect->error);
            }

            $selection = [];
            while ($row = $result->fetch_assoc()) {
                $selection[] = $row;
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->closeConnection();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->closeConnection();

        return $selection;
    }

    /**
     * @param string $query
     *
     * @return int
     * @throws FafiException
     */
    public function write(string $query): int
    {
        $connect = $this->dbConnector->open();
        $connect->begin_transaction();

        try {
            $result = $connect->query($query);
            if (!$result) {
                $this->fail($connect->error);
            }

            $id = $connect->insert_id;
            if (!$id) {
                $this->fail($connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->closeConnection();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->closeConnection();

        return $id;
    }

    /**
     * @param string $query
     *
     * @return void
     * @throws FafiException
     */
    public function rewrite(string $query): void
    {
        $connect = $this->dbConnector->open();
        $connect->begin_transaction();

        try {
            $result = $connect->query($query);
            if (!$result) {
                $this->fail($connect->error);
            }
        } catch (FafiException $e) {
            $connect->rollback();
            $this->dbConnector->closeConnection();

            throw $e;
        }

        $connect->commit();
        $this->dbConnector->closeConnection();
    }


    /**
     * @param string $connectError
     *
     * @return void
     * @throws FafiException
     */
    private function fail(string $connectError): void
    {
        throw new FafiException(DbErr::DB_OPERATE_FAILED . EOL . $connectError);
    }
}
