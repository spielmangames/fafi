<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Geo;

use FAFI\src\BE\Domain\Service\GeoService;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class CountryNameToIdFieldConverter implements ImportFieldConverter
{
    private GeoService $service;

    public function __construct()
    {
        $this->service = new GeoService();
    }


    public function fromStr(string $property, string $value): ?int
    {
        return $this->service->findCountryByName($value)?->getId();
    }
}
