<?php

declare(strict_types=1);

namespace FAFI\exception;

interface ImExErr extends Err
{
    public const IMPORT_FAILED = 'Importing failed on line %d.';
    public const IMPORT_DATA_ABSENT = 'There is no data to update %s.';

    public const IMPORT_ENTITY_FIELD_CONVERTER_ABSENT = 'Field "%s" Converter is absent in %s Config.';
    public const IMPORT_ENTITY_FIELD_CONVERTER_INVALID = 'Field "%s" Converter is invalid in %s Config.';
    public const IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT = 'Field "%s" Specification is absent in %s Config.';
    public const IMPORT_ENTITY_FIELD_SPECIFICATION_INVALID = 'Field "%s" Specification is invalid in %s Config.';
    public const IMPORT_ENTITY_FIELD_SPECIFICATION_PARAM_INVALID = 'Specification param "%s" is invalid.';
    public const ENTITY_FIELD_NOT_MAPPED = 'The "%s" field is not mapped.';

    public const ENTITY_IMPORT_NOT_SUPPORTED = 'Entity "%s" is not supported for Import.';
}
