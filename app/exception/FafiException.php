<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const E_PLAYER_IS_MISSED = 'Player is required for %s.';

    public const E_TAB_NOT_SET = 'Tab is not set for %s.';
    public const E_TAB_NOT_SUPPORTED = 'Tab %s is not supported for %s.';

    public const E_IMPORT_FILE_HEADER_INVALID = 'File header must be separated from data with an empty line.';
}
