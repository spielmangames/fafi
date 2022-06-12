<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\PositionClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\PositionHydrator;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PositionSpecification;

class ImportPositions extends AbstractEntityImport
{
    protected PositionSpecification $entitySpecification;
    protected PositionHydrator $entityHydrator;
    protected PositionClient $entityLoader;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PositionSpecification();
        $this->entityHydrator = new PositionHydrator();
        $this->entityLoader = new PositionClient();
    }
}
