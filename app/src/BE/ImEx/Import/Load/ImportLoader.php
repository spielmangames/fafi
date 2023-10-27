<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import\Load;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Clients\EntityClientFactory;
use FAFI\src\BE\ImEx\Clients\EntityClientInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportLoader
{
    private int $line;


    private EntityClientFactory $entityClientFactory;

    public function __construct()
    {
        $this->entityClientFactory = new EntityClientFactory();
    }


    /**
     * @param EntityDataInterface[] $transformedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    public function load(array $transformedRows, ImportableEntityConfig $entityConfig): void
    {
        foreach ($transformedRows as $line => $transformedRow) {
            $this->line = $line;
            $this->loadEntity($transformedRow, $entityConfig);
        }
    }


    /**
     * @param EntityDataInterface $transformedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return void
     * @throws FafiException
     */
    private function loadEntity(EntityDataInterface $transformedRow, ImportableEntityConfig $entityConfig): void
    {
        $loader = $this->prepareResourceLoader($entityConfig);
        $loader->save($transformedRow);
    }

    /**
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityClientInterface
     * @throws FafiException
     */
    private function prepareResourceLoader(ImportableEntityConfig $entityConfig): EntityClientInterface
    {
        $class = $entityConfig->getResourceLoader();

        try {
            $loader = $this->entityClientFactory->create($class);
        } catch (FafiException $exception) {
            $this->fail($exception->getMessage());
        }

        return $loader;
    }


    /**
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    private function fail(string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $this->line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
