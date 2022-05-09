<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\GeoCountry\CountryService;
use FAFI\entity\ImEx\Transformer\Hydrator\CountryTrHydrator;
use FAFI\entity\ImEx\Transformer\Specification\Entity\CountrySpecification;
use FAFI\exception\FafiException;

class ImportCountries extends AbstractEntityImport
{
    private CountrySpecification $countrySpecification;
    private CountryTrHydrator $countryTrHydrator;
    private CountryService $countryService;

    public function __construct()
    {
        parent::__construct();
        $this->countrySpecification = new CountrySpecification();
        $this->countryTrHydrator = new CountryTrHydrator();
        $this->countryService = new CountryService();
    }


    /**
     * @param string $filePath
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath): void
    {
        $extracted = $this->importExtractor->extract($filePath);
        $transformed = $this->transform($extracted, $this->countrySpecification);
        $this->load($transformed);
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
