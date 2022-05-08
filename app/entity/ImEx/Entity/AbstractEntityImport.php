<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\data\CsvFileHandler;
use FAFI\data\FileValidator;
use FAFI\entity\ImEx\ImExService;
use FAFI\entity\ImEx\Transformer\Schema\AbstractFileSchema;
use FAFI\entity\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;
use FAFI\exception\FafiException;

abstract class AbstractEntityImport
{
    private const IM_FILE_SIZE_LIMIT = 1048576;


    private FileValidator $fileValidator;
    private CsvFileHandler $fileHandler;
    private ImExFieldSpecificationFactory $fieldSpecificationFactory;

    public function __construct()
    {
        $this->fileValidator = new FileValidator();
        $this->fileHandler = new CsvFileHandler();
        $this->fieldSpecificationFactory = new ImExFieldSpecificationFactory();
    }


    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    public function extract(string $filePath): array
    {
        $this->fileValidator->validateFile($filePath, ImExService::FILE_EXT, self::IM_FILE_SIZE_LIMIT);
        $extracted = $this->fileHandler->read($filePath);
        $this->fileValidator->validateFileContentPresent($filePath, $extracted);

        return $this->removeHeaderDelimiterLine($extracted);
    }

    /**
     * @param array $extracted
     *
     * @return array
     * @throws FafiException
     */
    private function removeHeaderDelimiterLine(array $extracted): array
    {
        $lineToRemove = 2;
        try {
            $removeLine = $extracted[$lineToRemove];
            $this->fileValidator->validateLineEmpty($removeLine);
            unset($extracted[$lineToRemove]);
        } catch (FafiException $e) {
            $e = implode(EOL, [$e->getMessage(), FafiException::E_IMPORT_FILE_HEADER_INVALID]);
            throw new FafiException($e);
        }

        return $extracted;
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
        foreach ($entitySpecification->getMandatoryFieldsOnCreate() as $mandatory) {
            if (!isset($entity[$mandatory])) {
                $e = sprintf(FafiException::E_IMPORT_FAILED, $line);
                throw new FafiException($e);
            }
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
            $e = sprintf(FafiException::E_IMPORT_FAILED, $line);
            throw new FafiException($e);
        }
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
