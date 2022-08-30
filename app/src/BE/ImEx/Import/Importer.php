<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Extract\ImportExtractor;
use FAFI\src\BE\ImEx\Import\Load\ImportLoader;
use FAFI\src\BE\ImEx\Transformer\ImportTransformer;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

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
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath, ImportableEntityConfig $entityConfig): void
    {
        $extracted = $this->importExtractor->extract($filePath);
        $transformed = $this->importTransformer->transform($extracted, $entityConfig);
        $this->importLoader->load($transformed, $entityConfig);
    }
}
