<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Entity;

use FAFI\src\ImEx\Transformer\Hydrator\PositionTrHydrator;
use FAFI\src\ImEx\Transformer\Specification\Entity\PositionSpecification;
use FAFI\src\Position\PositionService;
use FAFI\exception\FafiException;

class ImportPositions extends AbstractEntityImport
{
    protected PositionSpecification $entitySpecification;
    protected $entityHydrator;
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
