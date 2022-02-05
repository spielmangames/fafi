<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\PositionTransformer;
use FAFI\entity\Position\Position;
use FAFI\entity\Position\PositionService;
use FAFI\exception\FafiException;

class ImportPositions extends AbstractEntityImport
{
    private PositionTransformer $positionTransformer;
    private PositionService $positionService;

    public function __construct()
    {
        parent::__construct();
        $this->positionTransformer = new PositionTransformer();
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
        $transformed = $this->transform($extracted);
        $this->load($transformed);
    }

    /**
     * @param array $entities
     *
     * @return Position[]
     * @throws FafiException
     */
    public function transform(array $entities): array
    {
        return $this->positionTransformer->hydrateCollection($entities);
    }

    /**
     * @param Position[] $entities
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
