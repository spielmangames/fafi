<?php

declare(strict_types=1);

namespace FAFI\logs;

class Logger
{
    public static function logStart(string $subject): void
    {
        echo(self::wrapSubject($subject) . LogAction::SAY . LogAction::START);
        echo EOL;
    }

    public static function logFinish(string $subject): void
    {
        echo(self::wrapSubject($subject) . LogAction::SAY . LogAction::FINISH);
        echo EOL;
    }


    private static function wrapSubject(string $subject): string
    {
        return LogAction::WRAP_LEFT . $subject . LogAction::WRAP_RIGHT;
    }
}
