<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PositionSpecification;

class ImportPositions extends AbstractEntityImport
{
    protected PositionSpecification $entitySpecification;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PositionSpecification();
    }
}
