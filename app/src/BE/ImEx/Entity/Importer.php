<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Persistence\ImportLoader;
use FAFI\src\BE\ImEx\Storage\ImportExtractor;
use FAFI\src\BE\ImEx\Transformer\ImportTransformer;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;

class Importer
{
    protected ImportExtractor $importExtractor;
    protected ImportTransformer $importTransformer;
    protected ImportLoader $importLoader;

    public function __construct()
    {
        $this->importExtractor = new ImportExtractor();
        $this->importTransformer = new ImportTransformer();
        $this->importLoader = new ImportLoader();
    }


    /**
     * @param string $filePath
     * @param ImExEntitySpecification $entitySpecification
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath, ?ImExEntitySpecification $entitySpecification = null): void
    {
        throw new FafiException(sprintf(ImExErr::ENTITY_IMPORT_NOT_SUPPORTED, $entityName));


        $extracted = $this->importExtractor->extract($filePath);

        $transformed = $this->importTransformer->transform($extracted, $entitySpecification);

        $this->importLoader->load($transformed, $entitySpecification);
    }
}
