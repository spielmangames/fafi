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
    protected EntityHydratorInterface $entityHydrator;
    protected EntityDataHydratorInterface $entityDataHydrator;

    protected DatabaseValidator $dbValidator;
    protected QueryExecutor $queryExecutor;

    public function __construct(
        EntityHydratorInterface $entityHydrator,
        EntityDataHydratorInterface $entityDataHydrator,
    ) {
        $this->entityValidator = new EntityValidator();
        $this->entityHydrator = $entityHydrator;
        $this->entityDataHydrator = $entityDataHydrator;

        $this->dbValidator = new DatabaseValidator();
        $this->queryExecutor = new QueryExecutor();
    }

    abstract protected function getTable(): string;
    abstract protected function getRequiredFields(): array;
    abstract protected function getUniqueFields(): array;


    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface|null
     * @throws FafiException
     */
    public function read(array $conditions): ?EntityInterface
    {
        $selection = $this->list($conditions);
        return !empty($selection) ? array_shift($selection) : null;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        $selection = $this->queryExecutor->readRecords($this->getTable(), $conditions);
        return $this->entityHydrator->hydrateCollection($selection);
    }


    /**
     * @param EntityDataInterface $entityData
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): EntityInterface
    {
        $request = $this->entityDataHydrator->dehydrate($entityData);
//        $request = $this->skipNullValues($request);
        $this->verifyConstraintsOnCreate($this->getTable(), $entityData, $request);

        $id = $this->queryExecutor->createRecord($this->getTable(), $request);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->read([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(EntityErr::ENTITY_ABSENT, $entityData, self::ID_FIELD, $id));
        }

        return $result;
    }

    /**
     * @param EntityDataInterface $entityData
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): EntityInterface
    {
        throw new FafiException('Needs to be tested!');

        $request = $this->entityDataHydrator->dehydrate($entityData);
        $request = $this->skipNullValues($request);
        $this->verifyConstraintsOnUpdate($this->getTable(), $entityData, $request);

        $id = $entityData->getId();
        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->queryExecutor->updateRecord($this->getTable(), $request, [$criteria]);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->read([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(EntityErr::ENTITY_ABSENT, $entityData, self::ID_FIELD, $id));
        }

        return $result;
    }

    /**
     * See FAFI-002 for details
     *
     * @param array $entityDataAsArray
     *
     * @return array
     */
    private function skipNullValues(array $entityDataAsArray): array
    {
        return array_filter($entityDataAsArray, fn($propertyValue) => !is_null($propertyValue));
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return void
     * @throws FafiException
     */
    public function delete(array $conditions = []): void
    {
        throw new FafiException('Forbidden. See FAFI-004 for details.');
        $this->queryExecutor->deleteRecords($this->getTable(), $conditions);
    }


    /**
     * @param string $table
     * @param EntityDataInterface $entity
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function verifyConstraintsOnCreate(string $table, EntityDataInterface $entity, array $data): void
    {
        $this->entityValidator::assertEntityIdAbsent($entity);
        $this->entityValidator::assertEntityMandatoryDataPresent($entity, $data, $this->getRequiredFields());

        $this->verifyModelConstraints($table, $entity, $data);
    }

    /**
     * @param string $table
     * @param EntityDataInterface $entity
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function verifyConstraintsOnUpdate(string $table, EntityDataInterface $entity, array $data): void
    {
        $this->entityValidator::assertEntityIdPresent($entity);

        $this->verifyModelConstraints($table, $entity, $data);
    }

    /**
     * @param string $table
     * @param EntityDataInterface $entity
     * @param array $data
     *
     * @return void
     * @throws FafiException
     */
    private function verifyModelConstraints(string $table, EntityDataInterface $entity, array $data): void
    {
        $this->verifyModelPropertiesConstraints($data);

        foreach ($this->getUniqueFields() as $uniqueField) {
            $this->dbValidator->assertPropertyUnique($table, $entity::class, $data, $uniqueField);
        }
    }

    abstract protected function verifyModelPropertiesConstraints(array $data): void;
}
