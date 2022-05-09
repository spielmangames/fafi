<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\Hydrator\PositionTrHydrator;
use FAFI\entity\ImEx\Transformer\Specification\Entity\PositionSpecification;
use FAFI\entity\Position\PositionService;
use FAFI\exception\FafiException;

class ImportPositions extends AbstractEntityImport
{
    private PositionSpecification $entitySpecification;
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
