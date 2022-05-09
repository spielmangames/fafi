<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer;


use FAFI\src\ImEx\Transformer\Schema\AbstractFileSchema;
use FAFI\src\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;
use FAFI\src\Player\Player;
use FAFI\exception\FafiException;

class ImportTransformer
{
    private ImExFieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        $this->fieldSpecificationFactory = new ImExFieldSpecificationFactory();
    }


    /**
     * @param array $entities
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return array
     * @throws FafiException
     */
    public function transform(array $entities, ImExEntitySpecification $entitySpecification): array
    {
        $result = [];

        $fieldSpecifications = $this->prepareFieldSpecifications($entitySpecification);
        foreach ($entities as $line => $entity) {
            $this->validateEntityContent($line, $entity, $entitySpecification);
            $this->transformEntity($line, $entity, $fieldSpecifications);
        }

        return $result;
    }

    /**
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return array
     * @throws FafiException
     */
    private function prepareFieldSpecifications(ImExEntitySpecification $entitySpecification): array
    {
        $fieldSpecifications = [];

        $fieldSpecificationClasses = $entitySpecification->getFieldSpecifications();
        foreach ($fieldSpecificationClasses as $fieldName => $className) {
            $fieldSpecifications[$fieldName] = $this->fieldSpecificationFactory->create($className);
        }

        return $fieldSpecifications;
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    private function validateEntityContent(int $line, array $entity, ImExEntitySpecification $entitySpecification): void
    {
        array_key_exists(AbstractFileSchema::ID, $entity)
            ? $this->validateMandatory($line, $entity, $entitySpecification)
            : $this->validateContentPresent($line, $entity, $entitySpecification);
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    private function validateMandatory(int $line, array $entity, ImExEntitySpecification $entitySpecification): void
    {
        $missed = [];
        foreach ($entitySpecification->getMandatoryFieldsOnCreate() as $mandatory) {
            if (!isset($entity[$mandatory])) {
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
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    private function validateContentPresent(int $line, array $entity, ImExEntitySpecification $entitySpecification): void
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

    /**
     * @param int $line
     * @param array $entity
     * @param array $fieldSpecifications
     *
     * @return array
     * @throws FafiException
     */
    private function transformEntity(int $line, array $entity, array $fieldSpecifications): array
    {
        $transformed = [];

        /** @var ImExFieldSpecification $fieldSpecification */
        foreach ($fieldSpecifications as $fieldName => $fieldSpecification) {
            if (!array_key_exists($fieldName, $entity)) {
                continue;
            }

            $this->transformEntityField($line, $fieldName, $entity[$fieldName], $fieldSpecification);
//            $transformed[$line] = $field;
        }

        return $transformed;
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
    private function transformEntityField(
        int $line,
        string $fieldName,
        $fieldValue,
        ImExFieldSpecification
        $fieldSpecification
    ): void {
        try {
            $fieldSpecification->validate($fieldName, $fieldValue);
        } catch (FafiException $e) {
            $e = sprintf(FafiException::E_IMPORT_FAILED, $line) . ' ' . $e->getMessage();
            throw new FafiException($e);
        }
    }
}
