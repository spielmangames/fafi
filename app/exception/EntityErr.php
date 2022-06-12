<?php

namespace FAFI\exception;

interface EntityErr extends Err
{
    public const ENTITY_ABSENT = '%s (%s = %s) is absent.';

    public const REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const ID_ABSENT = 'ID is required for updating %s and can not be null.';
    public const ID_PRESENT = 'ID must be absent for creating %s.';

    public const ENTITY_NOT_UNIQUE = '%s must have unique "%s".';


    public const E_VALUE_TYPE_INVALID_ENUM = 'Property "%s" value is not supported.';
}
