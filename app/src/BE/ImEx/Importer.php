<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Persistence\ImportLoader;
use FAFI\src\BE\ImEx\Storage\ImportExtractor;
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
        $extracted = $this->extract($filePath);
        $transformed = $this->transform($extracted, $entityConfig);
        $this->load($transformed, $entityConfig);
    }

    /**
     * @param string $filePath
     *
     * @return array
     * @throws FafiException
     */
    private function extract(string $filePath): array
    {
        return $this->importExtractor->extract($filePath);
    }

    /**
     * @param array $extracted
     * @param ImportableEntityConfig $entityConfig
     *
     * @return array
     * @throws FafiException
     */
    private function transform(array $extracted, ImportableEntityConfig $entityConfig): array
    {
        // init config transformer classes here !!!
        return $this->importTransformer->transform($extracted, $entityConfig);
    }

    /**
     * @param array $transformed
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function load(array $transformed, ImportableEntityConfig $entityConfig): void
    {
        // init config loader classes here !!!
        $this->importLoader->load($transformed, $entityConfig);
    }
}
