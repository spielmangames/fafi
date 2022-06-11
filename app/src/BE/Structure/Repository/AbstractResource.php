<?php

namespace FAFI\src\BE\Structure\Repository;

use FAFI\db\DatabaseValidator;
use FAFI\db\QueryExecutor;
use FAFI\db\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Structure\EntityInterface;

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


    /**
     * @param EntityInterface $entity
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $data = $this->hydrator->extract($entity);

        $this->verifyConstraintsOnCreate($this->getTable(), $entity, $data);
        $id = $this->queryExecutor->createRecord($this->getTable(), $data);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, $entity, $id));
        }

        return $result;
    }

    abstract protected function verifyConstraintsOnCreate(string $table, EntityInterface $entity, array $data): void;

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return EntityInterface[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        $selection = $this->queryExecutor->readRecords($this->getTable(), $conditions);

        $result = [];
        foreach ($selection as $record) {
            $result[] = $this->hydrator->hydrate($record);
        }

        return $result;
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
     * @param EntityInterface $entity
     *
     * @return EntityInterface
     * @throws FafiException
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->entityValidator->assertEntityIdPresent($entity);
        $id = $entity->getId();
        $data = $this->hydrator->extract($entity);

        // assert constraints before operation
        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $this->queryExecutor->updateRecord($this->getTable(), $data, [$criteria]);

        $criteria = new Criteria(self::ID_FIELD, QuerySyntax::OPERATOR_IS, [$id]);
        $result = $this->readFirst([$criteria]);
        if (!$result) {
            throw new FafiException(sprintf(FafiException::E_ENTITY_ABSENT, $entity, $id));
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
}
