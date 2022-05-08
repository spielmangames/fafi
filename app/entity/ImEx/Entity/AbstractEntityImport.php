<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\data\CsvFileHandler;
use FAFI\data\FileValidator;
use FAFI\entity\ImEx\ImExService;
use FAFI\entity\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\exception\FafiException;

abstract class AbstractEntityImport
{
    private const IM_FILE_LIMIT = 1048576;


    private FileValidator $fileValidator;
    private CsvFileHandler $fileHandler;

    public function __construct()
    {
        $this->fileValidator = new FileValidator();
        $this->fileHandler = new CsvFileHandler();
    }


    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    public function extract(string $filePath): array
    {
        $this->fileValidator->validateFile($filePath, ImExService::FILE_EXT, self::IM_FILE_LIMIT);
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
        try {
            $removeLine = array_shift($extracted);
            $this->fileValidator->validateLineEmpty($removeLine);
        } catch (FafiException $e) {
            $e = implode(EOL, [$e->getMessage(), FafiException::E_IMPORT_FILE_HEADER_INVALID]);
            throw new FafiException($e);
        }

        return $extracted;
    }

    public function transform(array $entities, ImExEntitySpecification $entitySpecification): array
    {
        $result = [];

        $fieldSpecifications = $entitySpecification->getFieldSpecifications();

        /**
         * @var $fieldSpecification
         */
        foreach ($fieldSpecifications as $field => $fieldSpecification) {
//            $validation = $fieldSpecification->
        }

        return $result;
    }
}
