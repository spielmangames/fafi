<?php

declare(strict_types=1);

namespace FAFI\db;

use FAFI\exception\DbErr;
use mysqli;

class DatabaseConnector
{
    private ?mysqli $connection = null;


    private DatabaseSettings $databaseSettings;

    public function __construct()
    {
        $this->databaseSettings = new DatabaseSettings();
    }


    public function open(bool $withDb = true): mysqli
    {
        $host = $this->databaseSettings->getHostname();
        $username = $this->databaseSettings->getUsername();
        $password = $this->databaseSettings->getPassword();
        $dbname = $withDb ? $this->databaseSettings->getDbname() : null;

        $this->connection = new mysqli($host, $username, $password, $dbname);
        $this->verifyConnection($this->connection);

        return $this->connection;
    }

    private function verifyConnection(mysqli $connection): void
    {
        if ($connection->connect_error) {
            die(DbErr::DB_CONNECT_BROKEN . EOL . $connection->connect_error);
        }
    }


    public function closeConnection(): void
    {
        $connection = $this->getConnection();
        if ($connection) {
            if (!$connection->close()) {
                echo DbErr::DB_CONNECT_CLOSE_FAILED;
            }
            unset($this->connection);
        }
    }

    private function getConnection(): ?mysqli
    {
        return $this->connection;
    }
}
