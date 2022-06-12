<?php

namespace FAFI\exception;

interface EntityErr extends Err
{
    public const ENTITY_ABSENT = '%s (%s = %d) is absent.';

    public const REQ_MISSED = 'Required fields are missed for %s: "%s".';
    public const ENTITY_NOT_UNIQUE = '%s must have unique "%s".';
}
