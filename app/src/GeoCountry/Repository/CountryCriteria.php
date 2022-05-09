<?php

namespace FAFI\src\GeoCountry\Repository;

use FAFI\src\Structure\Repository\EntityCriteriaInterface;

class CountryCriteria implements EntityCriteriaInterface
{
    /** @var int[]|null */
    private ?array $ids;

    /** @var string[]|null */
    private ?array $names;

    /**
     * @param int[]|null $ids
     * @param string[]|null $names
     */
    public function __construct(
        ?array $ids = null,
        ?array $names = null
    ) {
        $this->ids = $ids;
        $this->names = $names;
    }


    public function getIds(): ?array
    {
        return $this->ids;
    }

    /** @return string[]|null */
    public function getNames(): ?array
    {
        return $this->names;
    }


    public function isEmpty(): bool
    {
        return empty($this->ids) && empty($this->names);
    }
}
