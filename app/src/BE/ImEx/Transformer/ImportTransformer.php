<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Player\Player;
use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\ImExFieldTransformerFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;

class ImportTransformer
{
    private ImExFieldTransformerFactory $fieldTransformerFactory;
    private ImExFieldSpecificationFactory $fieldSpecificationFactory;
    private ImportEntityValidator $entityValidator;

    public function __construct()
    {
        $this->fieldTransformerFactory = new ImExFieldTransformerFactory();
        $this->fieldSpecificationFactory = new ImExFieldSpecificationFactory();
        $this->entityValidator = new ImportEntityValidator();
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
        $transformed = [];

        foreach ($entities as $line => $entity) {
            $this->entityValidator->validateEntity($line, $entity, $entitySpecification);
            $transformed[$line] = $this->transformEntity($line, $entity, $entitySpecification);
        }

        return $transformed;
    }

    /**
     * @param int $line
     * @param array $entity
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return array
     * @throws FafiException
     */
    private function transformEntity(int $line, array $entity, ImExEntitySpecification $entitySpecification): array
    {
        $transformed = [];

        foreach ($entity as $fieldName => $fieldValue) {
            if ($fieldValue === '') {
                $fieldValue = null;
            } else {
                $fieldTransformer = $this->prepareFieldTransformer($line, $entitySpecification, $fieldName);
                $fieldValue = $fieldTransformer->fromStr($fieldName, $fieldValue);

                $fieldSpecification = $this->prepareFieldSpecification($line, $entitySpecification, $fieldName);
                $fieldSpecification->validate($fieldName, $fieldValue);
            }

            $transformed[$fieldName] = $fieldValue;
        }

        return $transformed;
    }

    /**
     * @param int $line
     * @param ImExEntitySpecification $entitySpecification
     * @param string $fieldName
     *
     * @return ImExFieldSpecification
     * @throws FafiException
     */
    private function prepareFieldSpecification(int $line, ImExEntitySpecification $entitySpecification, string $fieldName): ImExFieldSpecification
    {
        $fieldSpecificationsMap = $entitySpecification->getFieldSpecificationsMap();

        if (!isset($fieldSpecificationsMap[$fieldName])) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(ImExErr::IMPORT_ENTITY_FIELD_SPECIFICATION_ABSENT, $fieldName, Player::ENTITY),
            ];
            throw new FafiException(FafiException::combine($e));
        }

        return $this->fieldSpecificationFactory->create($fieldSpecificationsMap[$fieldName]);
    }

    /**
     * @param int $line
     * @param ImExEntitySpecification $entitySpecification
     * @param string $fieldName
     *
     * @return ImExFieldTransformer
     * @throws FafiException
     */
    private function prepareFieldTransformer(int $line, ImExEntitySpecification $entitySpecification, string $fieldName): ImExFieldTransformer
    {
        $fieldTransformersMap = $entitySpecification->getFieldTransformersMap();

        if (!isset($fieldTransformersMap[$fieldName])) {
            $e = [
                sprintf(ImExErr::IMPORT_FAILED, $line),
                sprintf(ImExErr::IMPORT_ENTITY_FIELD_TRANSFORMER_ABSENT, $fieldName, Player::ENTITY),
            ];
            throw new FafiException(FafiException::combine($e));
        }

        return $this->fieldTransformerFactory->create($fieldTransformersMap[$fieldName]);
    }
}
