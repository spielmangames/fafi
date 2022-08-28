<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\EntityErr;
use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\ImEx\Transformer\Schema\File\AbstractFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;

class ImportEntityValidator
{
    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $specification
     *
     * @return void
     * @throws FafiException
     */
    public function validateEntity(int $line, array $entity, ImportableEntityConfig $specification): void
    {
        array_key_exists(AbstractFileSchema::ID, $entity)
            ? $this->assertContentPresent($line, $entity)
            : $this->assertMandatory($line, $entity, $specification);
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImportableEntityConfig $specification
     *
     * @return void
     * @throws FafiException
     */
    private function assertMandatory(int $line, array $entity, ImportableEntityConfig $specification): void
    {
        // TODO: revisit $entityName to become domain independent
        $entityName = Player::ENTITY;

        $missed = [];
        foreach ($specification->getMandatoryFieldsOnCreate() as $mandatory) {
            if (!isset($entity[$mandatory])) {
                $missed[] = $mandatory;
            }
            if ($entity[$mandatory] === '') {
                $missed[] = $mandatory;
            }
        }

        if (!empty($missed)) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(EntityErr::REQ_ABSENT, $entityName, implode(FafiException::LIST_WRAPPED_SEPARATOR, $missed)),
            ];
            throw new FafiException(FafiException::combine($e));
        }
    }

    /**
     * @param int $line
     * @param array $entity
     *
     * @return void
     * @throws FafiException
     */
    private function assertContentPresent(int $line, array $entity): void
    {
        // TODO: revisit $entityName to become domain independent
        $entityName = Player::ENTITY;

        $reserved = [AbstractFileSchema::ID];
        if (count($entity) <= count($reserved)) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(ImExErr::IMPORT_DATA_ABSENT, $entityName),
            ];
            throw new FafiException(FafiException::combine($e));
        }
    }


    public function validateEntityField(int $line, string $fieldName, ImExFieldSpecification $specification): void
    {

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
