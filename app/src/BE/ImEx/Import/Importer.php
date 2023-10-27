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
    private ImportExtractor $importExtractor;
    private ImportTransformer $importTransformer;
    private ImportLoader $importLoader;

    public function __construct()
    {
        $this->importExtractor = new ImportExtractor();
        $this->importTransformer = new ImportTransformer();
        $this->importLoader = new ImportLoader();
    }


    /**
     * @param string $filePath
     * @param ImportableEntityConfig $entityConfig
     * @param bool $logMemory
     *
     * @return void
     * @throws FafiException
     */
    public function import(string $filePath, ImportableEntityConfig $entityConfig, bool $logMemory = false): void
    {
        !$logMemory ?: $this->logMemoryUsage('before Import Extractor');
        $extracted = $this->importExtractor->extract($filePath);
        !$logMemory ?: $this->logMemoryUsage('after Import Extractor');

        !$logMemory ?: $this->logMemoryUsage('before Import Transformer');
        $transformed = $this->importTransformer->transform($extracted, $entityConfig);
        !$logMemory ?: $this->logMemoryUsage('after Import Transformer');

        !$logMemory ?: $this->logMemoryUsage('before Import Loader');
        $this->importLoader->load($transformed, $entityConfig);
        !$logMemory ?: $this->logMemoryUsage('after Import Loader');
    }

    private function logMemoryUsage(string $context): void
    {
        $memory = memory_get_usage();
        $log = sprintf('Memory usage: %s: %s.', $context, $memory);
        var_dump($log);
    }
}
