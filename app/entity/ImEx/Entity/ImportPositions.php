<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\Position\Position;
use FAFI\entity\Position\Repository\PositionHydrator;
use FAFI\entity\Position\Repository\PositionRepository;
use FAFI\exception\FafiException;

class ImportPositions extends AbstractEntityImport
{
    private PositionHydrator $positionHydrator;

    public function __construct()
    {
        $this->positionHydrator = new PositionHydrator();
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
     * @param array $data
     *
     * @return Position[]
     * @throws FafiException
     */
    public function transform(array $data): array
    {
        return $this->positionHydrator->hydrateCollection($data);
    }

    /**
     * @param Position[] $data
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $data): void
    {
        $repo = new PositionRepository();

        foreach ($data as $entity) {
            $repo->save($entity);
        }
    }
}
