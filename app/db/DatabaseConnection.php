<?php

namespace FAFI\db;

use FAFI\config\Settings;
use mysqli;

class DatabaseConnection
{
    private ?mysqli $connection = null;

    public function init(): mysqli
    {
        return $this->open()->use()->getConnection();
    }

    public function open(): self
    {
        $servername = Settings::getInstance()->get('db/host');
        $username = Settings::getInstance()->get('db/user');
        $password = Settings::getInstance()->get('db/pass');

        $this->connection = new mysqli($servername, $username, $password);
        $this->verifyConnect($this->connection);

        return $this;
    }

    public function verifyConnect(mysqli $connection)
    {
        if ($connection->connect_error) {
            die('Connection failed: ' . $connection->connect_error);
        }
    }

    public function use(): self
    {
        $db = Settings::getInstance()->get('db/name');

        $result = $this->getConnection()->select_db($db);
        if(!$result) {
            throw new \Exception('Failure on selecting the database.');
        }

        return $this;
    }

    public function getConnection(): ?mysqli
    {
        return $this->connection;
    }

    public function close(): void
    {
        $connection = $this->getConnection();
        if ($connection) {
            if (!$connection->close()) {
                echo 'Failure on closing the database connection.';
            }
            unset($this->connection);
        }
    }
}
