<?php

declare(strict_types=1);

namespace FAFI\src\BE\DB;

use FAFI\config\Settings;

final class DatabaseSettings
{
    private const SETTINGS_DB = 'db';

    private const SETTING_HOSTNAME = 'host';
    private const SETTING_USERNAME = 'user';
    private const SETTING_PASSWORD = 'pass';
    private const SETTING_DBNAME = 'name';


    public function getHostname(): string
    {
        return $this->getDbSetting(self::SETTING_HOSTNAME);
    }

    public function getUsername(): string
    {
        return $this->getDbSetting(self::SETTING_USERNAME);
    }

    public function getPassword(): string
    {
        return $this->getDbSetting(self::SETTING_PASSWORD);
    }

    public function getDbname(): string
    {
        return $this->getDbSetting(self::SETTING_DBNAME);
    }


    private function getDbSetting(string $settingKey): ?string
    {
        return $this->getDbSettings()[$settingKey];
    }

    private function getDbSettings(): array
    {
        return Settings::getInstance()->get(self::SETTINGS_DB);
    }
}
