<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\Hydrator\PositionTrHydrator;
use FAFI\entity\ImEx\Transformer\Specification\Entity\PositionSpecification;
use FAFI\entity\Position\PositionService;
use FAFI\exception\FafiException;

class ImportPositions extends AbstractEntityImport
{
    private PositionSpecification $positionSpecification;
    private PositionTrHydrator $positionTrHydrator;
    private PositionService $positionService;

    public function __construct()
    {
        parent::__construct();
        $this->positionSpecification = new PositionSpecification();
        $this->positionTrHydrator = new PositionTrHydrator();
        $this->positionService = new PositionService();
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
        $transformed = $this->transform($extracted, $this->positionSpecification);
        $this->load($transformed);
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
            $this->positionService->create($entity);
        }
    }
}
