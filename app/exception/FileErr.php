<?php

namespace FAFI\exception;

interface FileErr extends Err
{
    public const FILE_INVALID = 'File "%s" is invalid.';
    public const FILE_EXT_INVALID = 'File "%s" has unsupported extension.';
    public const FILE_TOO_LARGE = 'File "%s" is too large.';

    public const FILE_OPERATE_FAILED = 'Failed to operate with file.';

    public const FILE_DATA_ABSENT = 'No content data had been extracted from "%s".';
    public const LINE_NOT_EMPTY = 'Line is not empty: "%s" column contains data.';
}
