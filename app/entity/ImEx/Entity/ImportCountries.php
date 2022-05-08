<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\GeoCountry\Country;
use FAFI\entity\GeoCountry\CountryService;
use FAFI\entity\ImEx\Transformer\Hydrator\CountryTrHydrator;
use FAFI\exception\FafiException;

class ImportCountries extends AbstractEntityImport
{
    private CountryTrHydrator $countryTrHydrator;
    private CountryService $countryService;

    public function __construct()
    {
        parent::__construct();
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
        $extracted = $this->extract($filePath);
        $transformed = $this->transform($extracted);
        $this->load($transformed);
    }

    /**
     * @param array $entities
     *
     * @return Country[]
     */
    public function transform(array $entities): array
    {
        return $this->countryTrHydrator->hydrateCollection($entities);
    }

    /**
     * @param Country[] $entities
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->countryService->create($entity);
        }
    }
}
