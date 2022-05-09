<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Entity;

use FAFI\src\ImEx\Transformer\Hydrator\PlayerTrHydrator;
use FAFI\src\ImEx\Transformer\Specification\Entity\PlayerSpecification;
use FAFI\src\Player\Player;
use FAFI\src\Player\PlayerService;
use FAFI\exception\FafiException;

class ImportPlayers extends AbstractEntityImport
{
    protected PlayerSpecification $entitySpecification;
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
        foreach ($entities as $entity) {
            $player = new Player();

            $this->playerService->createPlayer($entity);
        }
    }
}
