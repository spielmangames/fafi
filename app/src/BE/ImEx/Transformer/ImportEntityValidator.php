<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Schema\File\AbstractFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

class ImportEntityValidator
{
    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    public function validateEntity(int $line, array $entity, ImportableEntityConfig $entityConfig): void
    {
        array_key_exists(AbstractFileSchema::ID, $entity)
            ? $this->assertContentPresent($line, $entity, $entityConfig)
            : $this->assertMandatory($line, $entity, $entityConfig);
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function assertContentPresent(int $line, array $entity, ImportableEntityConfig $entityConfig): void
    {
        $reserved = [AbstractFileSchema::ID];
        if (count($entity) <= count($reserved)) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(ImExErr::IMPORT_DATA_ABSENT, $entityConfig->getEntityName()),
            ];
            throw new FafiException(FafiException::combine($e));
        }
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function assertMandatory(int $line, array $entity, ImportableEntityConfig $entityConfig): void
    {
        $missed = [];
        foreach ($entityConfig->getMandatoryFieldsOnCreate() as $field) {
            if (!isset($entity[$field])) {
                $missed[] = $field;
            }
            if ($entity[$field] === '') {
                $missed[] = $field;
            }
        }

        if (!empty($missed)) {
            $missed = implode(FafiException::LIST_WRAPPED_SEPARATOR, $missed);
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(EntityErr::REQ_ABSENT, $entityConfig->getEntityName(), $missed),
            ];
            throw new FafiException(FafiException::combine($e));
        }
    }


    /**
     * @param int $line
     * @param string $fieldName
     * @param $fieldValue
     * @param ImExFieldSpecification $fieldSpecification
     *
     * @return void
     * @throws FafiException
     */
    private function assertEntityField(int $line, string $fieldName, $fieldValue, ImExFieldSpecification $specification): void
    {
        try {
            $specification->validate($fieldName, $fieldValue);
        } catch (FafiException $e) {
            $e = [sprintf(ImExErr::IMPORT_FAILED, $line), $e->getMessage()];
            throw new FafiException(FafiException::combine($e));
        }
    }
}
