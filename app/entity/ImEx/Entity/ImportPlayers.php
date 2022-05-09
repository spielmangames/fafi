<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\Hydrator\PlayerTrHydrator;
use FAFI\entity\ImEx\Transformer\Specification\Entity\PlayerSpecification;
use FAFI\entity\Player\Player;
use FAFI\entity\Player\PlayerService;
use FAFI\exception\FafiException;

class ImportPlayers extends AbstractEntityImport
{
    private PlayerSpecification $entitySpecification;
    private PlayerTrHydrator $playerTrHydrator;
    private PlayerService $playerService;

    public function __construct()
    {
        parent::__construct();
        $this->entitySpecification = new PlayerSpecification();
        $this->playerTrHydrator = new PlayerTrHydrator();
        $this->playerService = new PlayerService();
    }


    /**
     * @param array[] $entities
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $entities): void
    {
        $hydrated = $this->playerTrHydrator->hydrateCollection($entities);
        foreach ($entities as $entity) {
            $player = new Player();

            $this->playerService->createPlayer($entity);
        }
    }
}
