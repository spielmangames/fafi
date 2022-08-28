<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PlayerSpecification;

class ImporterPlayers extends AbstractEntityImporter
{
    protected PlayerSpecification $entitySpecification;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PlayerSpecification();
    }
}
