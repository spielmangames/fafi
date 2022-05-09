<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\ImEx\Transformer\Schema\AbstractFileSchema;
use FAFI\src\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\Player\Player;

class ImportEntityValidator
{
    /**
     * @param int $line
     * @param array $entity
     * @param ImExEntitySpecification $specification
     *
     * @return void
     * @throws FafiException
     */
    public function validateEntity(int $line, array $entity, ImExEntitySpecification $specification): void
    {
        array_key_exists(AbstractFileSchema::ID, $entity)
            ? $this->assertContentPresent($line, $entity)
            : $this->assertMandatory($line, $entity, $specification);
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImExEntitySpecification $specification
     *
     * @return void
     * @throws FafiException
     */
    private function assertMandatory(int $line, array $entity, ImExEntitySpecification $specification): void
    {
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
                sprintf(FafiException::E_IMPORT_FAILED, $line),
                sprintf(FafiException::E_REQ_MISSED, Player::ENTITY, implode('", "', $missed)),
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
        $reserved = [AbstractFileSchema::ID];
        if (count($entity) <= count($reserved)) {
            $e = [
                sprintf(FafiException::E_IMPORT_FAILED, $line),
                sprintf(FafiException::E_IMPORT_DATA_ABSENT, Player::ENTITY),
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
            $e = [sprintf(FafiException::E_IMPORT_FAILED, $line), $e->getMessage()];
            throw new FafiException(FafiException::combine($e));
        }
    }
}
