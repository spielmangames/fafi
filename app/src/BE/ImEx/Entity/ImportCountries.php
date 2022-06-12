<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\GeoCountry\Repository\CountryHydrator;
use FAFI\src\BE\ImEx\Persistence\Client\CountryClient;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\CountrySpecification;

class ImportCountries extends AbstractEntityImport
{
    protected CountrySpecification $entitySpecification;
    protected CountryHydrator $entityHydrator;
    protected CountryClient $entityLoader;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new CountrySpecification();
        $this->entityHydrator = new CountryHydrator();
        $this->entityLoader = new CountryClient();
    }
}
