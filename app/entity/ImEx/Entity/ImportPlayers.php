<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayerService;
use FAFI\entity\Player\Repository\PlayerHydrator;
use FAFI\exception\FafiException;

class ImportPlayers extends AbstractEntityImport
{
    private PlayerHydrator $playerHydrator;
    private PlayerService $playerService;

    public function __construct()
    {
        parent::__construct();
        $this->playerHydrator = new PlayerHydrator();
        $this->playerService = new PlayerService();
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
     * @return Player[]
     * @throws FafiException
     */
    public function transform(array $entities): array
    {
        return $this->playerHydrator->hydrateCollection($entities);
    }

    /**
     * @param Player[] $entities
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities): void
    {
        foreach ($entities as $entity) {
            $this->playerService->create($entity);
        }
    }
}
