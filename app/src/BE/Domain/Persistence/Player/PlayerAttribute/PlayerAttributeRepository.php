<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\RepositoryInterface;

class PlayerAttributeRepository implements RepositoryInterface
{
    private PlayerAttributeResource $attributeResource;

    public function __construct()
    {
        $this->attributeResource = new PlayerAttributeResource();
    }


    /**
     * @param int $id
     *
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function findById(int $id): ?PlayerAttribute
    {
        $criteria = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        return $this->attributeResource->read([$criteria]);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array
    {
        return $this->attributeResource->list($conditions);
    }


    /**
     * @param PlayerAttributeData $entity
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function save(EntityDataInterface $entity): PlayerAttribute
    {
        return $entity->getId() ? $this->attributeResource->update($entity) : $this->attributeResource->create($entity);
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
        $this->attributeResource->delete([$criteria]);
    }
}
