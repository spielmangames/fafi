<?php

namespace FAFI\db;

use FAFI\config\Setting;
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
        $servername = Setting::getInstance()->get('db/host');
        $username = Setting::getInstance()->get('db/user');
        $password = Setting::getInstance()->get('db/pass');

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
        $db = Setting::getInstance()->get('db/name');
        $this->getConnection()->select_db($db);

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
                echo 'Failure on closing the database connection!';
            }
            unset($this->connection);
        }
    }
}
