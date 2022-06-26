<?php

namespace FAFI\exception;

interface EntityErr extends Err
{
    public const ENTITY_ABSENT = '%s (%s = %s) is absent.';

    public const REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const ID_ABSENT = 'ID is required for updating %s and can not be null.';
    public const ID_PRESENT = 'ID must be absent for creating %s.';

    public const ENTITY_DATA_ABSENT = '%s contains no data.';
    public const ENTITY_NOT_UNIQUE = '%s must have unique "%s".';

    public const VALUE_TYPE_INVALID_ARR = 'Property "%s" must be array.';
    public const VALUE_TYPE_INVALID_BOOL = 'Property "%s" must be boolean.';
    public const VALUE_TYPE_INVALID_INT = 'Property "%s" must be integer.';
    public const VALUE_TYPE_INVALID_STR = 'Property "%s" must be string.';
    public const VALUE_TYPE_INVALID_ENUM = 'Property "%s" value is not supported.';

    public const VALUE_DIGIT_MIN_RANGE_CROSSED = 'Property "%s" must be ≥ %d.';
    public const VALUE_DIGIT_MAX_RANGE_CROSSED = 'Property "%s" must be ≤ %d.';
    public const VALUE_STR_MIN_LENGTH_CROSSED = 'Property "%s" length must be ≥ %d.';
    public const VALUE_STR_MAX_LENGTH_CROSSED = 'Property "%s" length must be ≤ %d.';
}
