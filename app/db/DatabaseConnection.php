<?php

namespace FAFI\db;

use FAFI\config\Settings;
use mysqli;

class DatabaseConnection
{
    private ?mysqli $connection = null;


    public function open(): mysqli
    {
        $servername = Settings::getInstance()->get('db/host');
        $username = Settings::getInstance()->get('db/user');
        $password = Settings::getInstance()->get('db/pass');
        $dbname = Settings::getInstance()->get('db/name');

        $this->connection = new mysqli($servername, $username, $password, $dbname);
        $this->verifyConnect($this->connection);

        return $this->connection;
    }

    public function verifyConnect(mysqli $connection): void
    {
        if ($connection->connect_error) {
            die('Connection failed: ' . $connection->connect_error);
        }
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
