<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\exception\FafiException;
use FAFI\src\BE\DB\Query\QuerySyntax;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerData;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerNameHelper;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class PlayerRepository implements RepositoryInterface
{
    use PlayerNameHelper;

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
     * @param string $fullName
     *
     * @return Player|null
     * @throws FafiException
     */
    public function findByFullName(string $fullName): ?Player
    {
        $criteria = $this->buildMultiCriteria($this->deconstructFullName($fullName));
        return $this->playerResource->read($criteria);
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


    protected function buildMultiCriteria(array $filters, string $operator = QuerySyntax::OPERATOR_IS): array
    {
        $resultCriteria = [];

        foreach($filters as $property => $value) {
            $resultCriteria[] = new Criteria($property, $operator, $value);
        }

        return $resultCriteria;
    }
}
