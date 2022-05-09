<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer;

use FAFI\src\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;
use FAFI\exception\FafiException;
use FAFI\src\Player\Player;

class ImportTransformer
{
    private ImExFieldSpecificationFactory $fieldSpecificationFactory;
    private ImportEntityTransformer $transformer;
    private ImportEntityValidator $entityValidator;

    public function __construct()
    {
        $this->fieldSpecificationFactory = new ImExFieldSpecificationFactory();
        $this->transformer = new ImportEntityTransformer();
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
        $fieldSpecifications = $this->prepareFieldSpecifications($entitySpecification);

        foreach ($entity as $fieldName => $fieldValue) {
            if (!isset($fieldSpecifications[$fieldName])) {
                $e = [
                    sprintf(FafiException::E_IMPORT_FAILED, $line),
                    sprintf(FafiException::E_IMPORT_ENTITY_FIELD_SPEC_ASSIGN_ABSENT, $fieldName, Player::ENTITY),
                ];
                throw new FafiException(FafiException::combine($e));
            }
            $fieldSpecification = $fieldSpecifications[$fieldName];

            $fieldValue = $this->transformer->transformField($fieldValue, $fieldSpecification);
            $fieldSpecification->validate($fieldName, $fieldValue);
        }

        return $transformed;
    }

    /**
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return ImExFieldSpecification[]
     * @throws FafiException
     */
    private function prepareFieldSpecifications(ImExEntitySpecification $entitySpecification): array
    {
        $fieldSpecifications = [];

        $fieldSpecificationsMap = $entitySpecification->getFieldSpecificationsMap();
        foreach ($fieldSpecificationsMap as $fieldName => $className) {
            $fieldSpecifications[$fieldName] = $this->fieldSpecificationFactory->create($className);
        }

        return $fieldSpecifications;
    }
}
