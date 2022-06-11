<?php

namespace FAFI\db;

interface QuerySyntax
{
    public const STATEMENT_INSERT = 'INSERT INTO %s (%s) VALUES (%s)';
    public const STATEMENT_SELECT = 'SELECT %s FROM %s%s';
    public const STATEMENT_UPDATE = 'UPDATE %s SET %s%s';
    public const STATEMENT_DELETE = 'DELETE FROM %s%s';
    public const STATEMENT_WHERE = ' WHERE %s';

    public const OPERATOR_ALL = '*';
    public const OPERATOR_IN = 'in';
    public const OPERATOR_IS = '=';

    public const VALUE_ABSENT = 'null';

    public const WRAPPER_CLOSE = ';';
    public const WRAPPER_VALUE = "'";
    public const SEPARATOR_LIST = ', ';
    public const SEPARATOR_AND = ' AND ';
}
