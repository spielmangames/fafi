<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\PlayerClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\PlayerHydrator;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PlayerSpecification;

class ImportPlayers extends AbstractEntityImport
{
    protected PlayerSpecification $entitySpecification;
    protected PlayerHydrator $entityHydrator;
    protected PlayerClient $entityLoader;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PlayerSpecification();
        $this->entityHydrator = new PlayerHydrator();
        $this->entityLoader = new PlayerClient();
    }
}
