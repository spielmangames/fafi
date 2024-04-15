<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Fail;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;

class ImportFailurer
{
    /**
     * @param int $line
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    public function fail(int $line, string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
