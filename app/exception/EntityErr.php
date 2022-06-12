<?php

namespace FAFI\exception;

interface EntityErr extends Err
{
    public const ENTITY_NOT_UNIQUE = '%s must have unique "%s".';
}
