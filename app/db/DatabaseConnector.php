<?php

namespace FAFI\db;

use FAFI\config\Settings;
use FAFI\exception\DbErr;
use mysqli;

class DatabaseConnector
{
    private const SETTINGS_DB = 'db';
    private const SETTING_HOSTNAME = 'host';
    private const SETTING_USERNAME = 'user';
    private const SETTING_PASSWORD = 'pass';
    private const SETTING_DBNAME = 'name';

    private ?mysqli $connection = null;


    public function open(bool $withDb = true): mysqli
    {
        $host = $this->getDbSetting(self::SETTING_HOSTNAME);
        $username = $this->getDbSetting(self::SETTING_USERNAME);
        $password = $this->getDbSetting(self::SETTING_PASSWORD);
        $dbname = $withDb ? $this->getDbSetting(self::SETTING_DBNAME) : null;

        $this->connection = new mysqli($host, $username, $password, $dbname);
        $this->verifyConnection($this->connection);

        return $this->connection;
    }


    private function getDbSettings(): array
    {
        return Settings::getInstance()->get(self::SETTINGS_DB);
    }

    private function getDbSetting(string $settingKey): ?string
    {
        return $this->getDbSettings()[$settingKey];
    }


    private function verifyConnection(mysqli $connection): void
    {
        if ($connection->connect_error) {
            die(DbErr::DB_CONNECT_BROKEN . EOL . $connection->connect_error);
        }
    }

    public function getConnection(): ?mysqli
    {
        return $this->connection;
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
}
