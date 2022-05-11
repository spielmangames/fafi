<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Entity;

use FAFI\exception\FafiException;
use FAFI\BE\ImEx\Persistence\ImportLoader;
use FAFI\BE\ImEx\Storage\ImportExtractor;
use FAFI\BE\ImEx\Transformer\ImportTransformer;

abstract class AbstractEntityImport
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
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath): void
    {
        $extracted = $this->importExtractor->extract($filePath);
        $transformed = $this->importTransformer->transform($extracted, $this->entitySpecification);
        $this->importLoader->load($transformed, $this->entityHydrator, $this->entityLoader);
    }
}
