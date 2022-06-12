<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_VALUE_TYPE_INVALID_ENUM = 'Property "%s" value is not supported.';

    public const E_PLAYER_IS_MISSED = 'Player is required for %s.';

    public const E_CLASS_ABSENT = 'Class "%s" is absent.';

    public const E_TAB_NOT_SET = 'Tab is not set for %s.';
    public const E_TAB_NOT_SUPPORTED = 'Tab %s is not supported for %s.';


    public const LIST_SEPARATOR = ", ";
    public const LIST_WRAPPED_SEPARATOR = '", "';


    public static function combine(array $messages): string
    {
        return implode(' ', $messages);
    }
}
