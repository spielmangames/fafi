<?php

namespace FAFI\db;

use FAFI\config\Settings;
use mysqli;

class DatabaseConnection
{
    private const E_DB_CONNECT_FAILED = 'Connection failed: %s';
    private const E_DB_CONNECT_CLOSING_FAILED = 'Failure on closing the database connection.';


    private ?mysqli $connection = null;


    public function open(bool $withDb = true): mysqli
    {
        $host = Settings::getInstance()->get('db/host');
        $username = Settings::getInstance()->get('db/user');
        $password = Settings::getInstance()->get('db/pass');
        $dbname = $withDb ? Settings::getInstance()->get('db/name') : null;

        $this->connection = new mysqli($host, $username, $password, $dbname);
        $this->verifyConnect($this->connection);

        return $this->connection;
    }

    public function verifyConnect(mysqli $connection): void
    {
        if ($connection->connect_error) {
            die(sprintf(self::E_DB_CONNECT_FAILED, $connection->connect_error));
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
                echo self::E_DB_CONNECT_CLOSING_FAILED;
            }
            unset($this->connection);
        }
    }
}
