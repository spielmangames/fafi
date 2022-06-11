<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const E_ENTITY_NOT_UNIQUE = '%s must have unique "%s".';
    public const E_ID_PRESENT = '"id" must be absent for creating %s.';
    public const E_ID_ABSENT = 'ID is required for updating %s and can not be null.';
    public const E_ENTITY_ABSENT = '%s (id = %d) is absent in storage.';
    public const E_ENTITY_PRESENT = '%s (id = %d) is present in storage.';
    public const E_ENTITY_OPERATION_FAILED = 'Failed to operate with items in storage.';

    public const E_PLAYER_IS_MISSED = 'Player is required for %s.';

    public const E_CLASS_ABSENT = 'Class "%s" is absent.';

    public const E_TAB_NOT_SET = 'Tab is not set for %s.';
    public const E_TAB_NOT_SUPPORTED = 'Tab %s is not supported for %s.';

    public const E_IMPORT_FILE_HEADER_INVALID = 'File header must be separated from data with an empty line.';
    public const E_IMPORT_FAILED = 'Importing failed on line %d.';
    public const E_IMPORT_DATA_ABSENT = 'There is no data to update %s.';

    public const E_IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT = 'Field "%s" Specification is absent in %s Config.';
    public const E_IMPORT_ENTITY_FIELD_TRANSFORMER_ABSENT = 'Field "%s" Transformer is absent in %s Config.';


    public const LIST_SEPARATOR = ", ";
    public const LIST_WRAPPED_SEPARATOR = '", "';


    public static function combine(array $messages): string
    {
        return implode(' ', $messages);
    }
}
