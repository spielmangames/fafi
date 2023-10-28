<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class PlayerRepository implements RepositoryInterface
{
    private PlayerResource $playerResource;

    public function __construct()
    {
        $this->playerResource = new PlayerResource();
    }


    /**
     * @param int $id
     *
     * @return Player|null
     * @throws FafiException
     */
    public function findById(int $id): ?Player
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->playerResource->read([$criteria]);
    }

    /**
     * @param string $name
     *
     * @return Player|null
     * @throws FafiException
     */
    public function findByFullName(string $name): ?Player
    {
        // TODO investigate this!!!
        $criteria = new Criteria(PlayerResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$name]);
        return $this->playerResource->read([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player[]
     * @throws FafiException
     */
    public function findCollection(array $conditions = []): array
    {
        return $this->playerResource->list($conditions);
    }


    /**
     * @param PlayerData $entity
     *
     * @return Player
     * @throws FafiException
     */
    public function save(EntityDataInterface $entity): Player
    {
        return $entity->getId() ? $this->playerResource->update($entity) : $this->playerResource->create($entity);
    }

    /**
     * @param int $id
     *
     * @return void
     * @throws FafiException
     */
    public function deleteById(int $id): void
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->playerResource->delete([$criteria]);
    }
}
