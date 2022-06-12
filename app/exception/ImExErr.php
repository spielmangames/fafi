<?php

namespace FAFI\exception;

interface ImExErr extends Err
{
    public const IMPORT_FILE_HEADER_INVALID = 'File header must be separated from data with an empty line.';
    public const IMPORT_FAILED = 'Importing failed on line %d.';
    public const IMPORT_DATA_ABSENT = 'There is no data to update %s.';

    public const IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT = 'Field "%s" Specification is absent in %s Config.';
    public const IMPORT_ENTITY_FIELD_TRANSFORMER_ABSENT = 'Field "%s" Transformer is absent in %s Config.';
}
