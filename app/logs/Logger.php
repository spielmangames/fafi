<?php

declare(strict_types=1);

namespace FAFI\logs;

class Logger
{
    public static function logStart(string $subject): void
    {
        echo($subject . LogAction::SAY . LogAction::START);
        echo EOL;
    }

    public static function logFinish(string $subject): void
    {
        echo($subject . LogAction::SAY . LogAction::FINISH);
        echo EOL;
    }
}
