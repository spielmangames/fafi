<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Integration;

use FAFI\exception\FafiException;
use FAFI\src\BE\DB\Query\QuerySyntax;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegration;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegrationData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class PlayerIntegrationRepository implements RepositoryInterface
{
    private IntegrationResource $integrationResource;

    public function __construct()
    {
        $this->integrationResource = new IntegrationResource();
    }


    /**
     * @param int $id
     *
     * @return PlayerIntegration|null
     * @throws FafiException
     */
    public function findById(int $id): ?PlayerIntegration
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->integrationResource->read([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerIntegration[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->integrationResource->list($conditions);
    }


    /**
     * @param PlayerIntegrationData $entity
     *
     * @return PlayerIntegration
     * @throws FafiException
     */
    public function save(EntityDataInterface $entity): PlayerIntegration
    {
        return $entity->getId() ? $this->integrationResource->update($entity) : $this->integrationResource->create($entity);
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
        $this->integrationResource->delete([$criteria]);
    }
}
