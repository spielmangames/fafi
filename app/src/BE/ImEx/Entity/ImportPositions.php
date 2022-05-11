<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\BE\ImEx\Transformer\Hydrator\PositionTrHydrator;
use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PositionSpecification;
use FAFI\src\BE\Position\PositionService;

class ImportPositions extends AbstractEntityImport
{
    protected PositionSpecification $entitySpecification;
    private PositionService $positionService;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PositionSpecification();
        $this->positionService = new PositionService();
    }


    /**
     * @param array[] $entities
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->positionService->createPosition($entity);
        }
    }
}
