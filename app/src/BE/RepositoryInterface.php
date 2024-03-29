<?php

declare(strict_types=1);

namespace FAFI\src\BE;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

interface RepositoryInterface
{
    /**
     * @param int $id
     *
     * @return EntityInterface|null
     * @throws FafiException
     */
    public function findById(int $id): ?EntityInterface;

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface[]
     * @throws FafiException
     */
    public function findCollection(array $conditions): array;


    /**
     * @param EntityDataInterface $entity
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function save(EntityDataInterface $entity): EntityInterface;

    /**
     * @param int $id
     *
     * @return void
     * @throws FafiException
     */
    public function deleteById(int $id): void;
}
