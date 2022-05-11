<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Entity;

use FAFI\BE\ImEx\Persistence\Client\PlayerClient;
use FAFI\BE\ImEx\Persistence\Hydrator\PlayerHydrator;
use FAFI\BE\ImEx\Transformer\Specification\Entity\PlayerSpecification;

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
