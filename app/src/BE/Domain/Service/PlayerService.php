<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Service;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Position\Position;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerRepository;
use FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute\PlayerAttributeRepository;
use FAFI\src\BE\Domain\Persistence\Player\Position\PositionRepository;

class PlayerService
{

    private PositionRepository $positionRepository;
    private PlayerRepository $playerRepository;
    private PlayerAttributeRepository $playerAttributeRepository;

    public function __construct()
    {
        $this->positionRepository = new PositionRepository();
        $this->playerRepository = new PlayerRepository();
        $this->playerAttributeRepository = new PlayerAttributeRepository();
    }


    /**
     * @param int $id
     *
     * @return Position|null
     * @throws FafiException
     */
    public function findPositionById(int $id): ?Position
    {
        return $this->positionRepository->findById($id);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Position[]
     * @throws FafiException
     */
    public function findPositionsCollection(array $conditions): array
    {
        return $this->positionRepository->findCollection($conditions);
    }

    /**
     * @param Position $position
     *
     * @return Position
     * @throws FafiException
     */
    public function savePosition(Position $position): Position
    {
        return $this->positionRepository->save($position);
    }


    /**
     * @param int $id
     *
     * @return Player|null
     * @throws FafiException
     */
    public function findPlayerById(int $id): ?Player
    {
        return $this->playerRepository->findById($id);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player[]
     * @throws FafiException
     */
    public function findPlayersCollection(array $conditions): array
    {
        return $this->playerRepository->findCollection($conditions);
    }

    /**
     * @param Player $player
     *
     * @return Player
     * @throws FafiException
     */
    public function savePlayer(Player $player): Player
    {
        $attributesToSave = $player->getAttributes();

        $player = $this->playerRepository->save($player);

        $attributes = [];
        if (!is_null($attributesToSave)) {
            foreach($attributesToSave as $attributeToSave) {
                $attributes[] = $this->playerAttributeRepository->save($attributeToSave);
            }
            $player->setAttributes($attributes);
        }

        return $player;
    }
}
