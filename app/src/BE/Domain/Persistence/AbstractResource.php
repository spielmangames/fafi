<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence;

use FAFI\db\DatabaseValidator;
use FAFI\db\Query\QueryExecutor;
use FAFI\db\Query\QuerySyntax;
use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\EntityInterface;

abstract class AbstractResource
{
    public const ID_FIELD = 'id';


    protected EntityValidator $entityValidator;
    protected DatabaseValidator $dbValidator;

    protected QueryExecutor $queryExecutor;

    public function __construct()
    {
        $this->entityValidator = new EntityValidator();
        $this->dbValidator = new DatabaseValidator();

        $this->queryExecutor = new QueryExecutor();
    }

    abstract protected function getTable(): string;
    abstract protected function getRequiredFields(): array;
    abstract protected function getUniqueFields(): array;


    /**
     * @param EntityDataInterface $entityData
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): EntityInterface
    {
        $data = $this->hydrator->extract($entityData);
        $this->verifyConstraintsOnCreate($this->getTable(), $entityData, $data);

        $id = $this->queryExecutor->createRecord($this->getTable(), $data);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(EntityErr::ENTITY_ABSENT, $entityData, self::ID_FIELD, $id));
        }

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        $selection = $this->queryExecutor->readRecords($this->getTable(), $conditions);
        return $this->hydrator->hydrateCollection($selection);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?EntityInterface
    {
        $selection = $this->read($conditions);
        return !empty($selection) ? array_shift($selection) : null;
    }

    /**
     * @param EntityDataInterface $entityData
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): EntityInterface
    {
        $data = $this->hydrator->extract($entityData);
        $this->verifyConstraintsOnUpdate($this->getTable(), $entityData, $data);

        $id = $entityData->getId();
        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->queryExecutor->updateRecord($this->getTable(), $data, [$criteria]);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(EntityErr::ENTITY_ABSENT, $entityData, self::ID_FIELD, $id));
        }

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return void
     * @throws FafiException
     */
    public function delete(array $conditions = []): void
    {
        $this->queryExecutor->deleteRecords($this->getTable(), $conditions);
    }


    private function verifyConstraintsOnCreate(string $table, EntityInterface $entity, array $data): void
    {
        $this->entityValidator->assertEntityIdAbsent($entity);
        $this->entityValidator->assertEntityMandatoryDataPresent($entity, $data, $this->getRequiredFields());

        $this->verifyModelConstraints($table, $entity, $data);
    }

    private function verifyConstraintsOnUpdate(string $table, EntityInterface $entity, array $data): void
    {
        $this->entityValidator->assertEntityIdPresent($entity);

        $this->verifyModelConstraints($table, $entity, $data);
    }

    private function verifyModelConstraints(string $table, EntityInterface $entity, array $data): void
    {
        $this->verifyModelPropertiesConstraints($data);

        foreach ($this->getUniqueFields() as $uniqueField) {
            $this->dbValidator->assertPropertyUnique($table, (string)$entity, $data, $uniqueField);
        }
    }

    abstract protected function verifyModelPropertiesConstraints(array $data): void;
}
