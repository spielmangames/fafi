<?php

declare(strict_types=1);

namespace FAFI\logs;

class Logger
{
    public static function logAppStart(): void
    {
        echo('FAFI 2023: started.');
        echo EOL;
    }

    public static function logAppFinish(): void
    {
        echo('FAFI 2023: finished.');
        echo EOL;
    }
}
