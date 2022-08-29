<?php

declare(strict_types=1);

namespace FAFI\exception;

interface DbErr extends Err
{
    public const DB_CONNECT_BROKEN = 'Database connection is broken.';
    public const DB_CONNECT_CLOSE_FAILED = 'Failed to close the database connection.';

    public const DB_OPERATE_FAILED = 'Failed to operate with storage.';
}
