<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\Hydrator\PlayerTrHydrator;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayerService;
use FAFI\exception\FafiException;

class ImportPlayers extends AbstractEntityImport
{
    private PlayerTrHydrator $playerTrHydrator;
    private PlayerService $playerService;

    public function __construct()
    {
        parent::__construct();
        $this->playerTrHydrator = new PlayerTrHydrator();
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
     */
    public function transform(array $entities): array
    {
        return $this->playerTrHydrator->hydrateCollection($entities);
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
