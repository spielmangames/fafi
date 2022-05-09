<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\GeoCountry\CountryService;
use FAFI\entity\ImEx\Transformer\Specification\Entity\CountrySpecification;
use FAFI\exception\FafiException;

class ImportCountries extends AbstractEntityImport
{
    private CountrySpecification $entitySpecification;
    private CountryService $countryService;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new CountrySpecification();
        $this->countryService = new CountryService();
    }


    /**
     * @param array $entities
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->countryService->createCountry($entity);
        }
    }
}
