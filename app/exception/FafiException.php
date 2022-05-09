<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const E_PLAYER_IS_MISSED = 'Player is required for %s.';

    public const E_CLASS_ABSENT = 'Class "%s" is absent.';

    public const E_TAB_NOT_SET = 'Tab is not set for %s.';
    public const E_TAB_NOT_SUPPORTED = 'Tab %s is not supported for %s.';

    public const E_IMPORT_FILE_HEADER_INVALID = 'File header must be separated from data with an empty line.';
    public const E_IMPORT_FAILED = 'Importing failed on line %d.';
    public const E_IMPORT_DATA_ABSENT = 'There is no data to update %s.';


    public static function combine(array $messages): string
    {
        return implode(' ', $messages);
    }
}
