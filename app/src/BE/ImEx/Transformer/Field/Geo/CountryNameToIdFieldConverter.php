<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Geo;

use FAFI\src\BE\Domain\Persistence\Geo\Country\CountryRepository;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class CountryNameToIdFieldConverter implements ImportFieldConverter
{
    private CountryRepository $repository;

    public function __construct()
    {
        $this->repository = new CountryRepository();
    }


    public function fromStr(string $property, string $value): ?int
    {
        return $this->repository->findByName($property)?->getId();
    }
}
