<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Schema\Mapper;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;

abstract class AbstractImExableEntityMapper implements ImExableEntityMapperInterface
{
    abstract public function getMap(): array;

    public function fromFile(string $field): string
    {
        $map = $this->getMap();
        return $map[$field] ?? $this->fail($field);
    }

    public function toFile(string $field): string
    {
        $map = array_flip($this->getMap());
        return $map[$field] ?? $this->fail($field);
    }

    /**
     * @param string $field
     *
     * @return void
     * @throws FafiException
     */
    private function fail(string $field): void
    {
        throw new FafiException(sprintf(ImExErr::ENTITY_FIELD_NOT_MAPPED, $field));
    }
}
