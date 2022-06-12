<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_CLASS_ABSENT = 'Class "%s" is absent.';


    public const LIST_SEPARATOR = ", ";
    public const LIST_WRAPPED_SEPARATOR = '", "';


    public static function combine(array $messages): string
    {
        return implode(' ', $messages);
    }
}
