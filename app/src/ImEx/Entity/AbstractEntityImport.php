<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Entity;

use FAFI\exception\FafiException;
use FAFI\src\ImEx\Extractor\ImportExtractor;
use FAFI\src\ImEx\Transformer\ImportTransformer;

abstract class AbstractEntityImport
{
    protected ImportExtractor $importExtractor;
    protected ImportTransformer $importTransformer;
    protected $entityConfig;
//    protected ImportLoader $importLoader;

    public function __construct()
    {
        $this->importExtractor = new ImportExtractor();
        $this->importTransformer = new ImportTransformer();
//        $this->importLoader = new ImportLoader();
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
        $transformed = $this->importTransformer->transform($extracted, $this->entityConfig);
        $this->load($transformed);
    }
}
