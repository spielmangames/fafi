<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfigFactory;

abstract class AbstractImportModule
{
    protected int $line;


    private ImportableEntityConfigFactory $importableEntityConfigFactory;

    public function __construct()
    {
        $this->importableEntityConfigFactory = new ImportableEntityConfigFactory();
    }


    protected function splitSubResources(array $entity, ImportableEntityConfig $entityConfig): array
    {
        $subEntities = [];

        foreach ($entity as $field => $value) {
            if ($this->isSubResource($field, $entityConfig)) {
                $subEntities[$field] = $value;
                unset($entity[$field]);
            }
        }

        return [$entity, $subEntities];
    }

    protected function isSubResource(string $fieldName, ImportableEntityConfig $entityConfig): bool
    {
        return array_key_exists($fieldName, $entityConfig->getSubResourcesMap());
    }

    protected function prepareSubResourceConfig(string $fieldName, ImportableEntityConfig $entityConfig): ImportableEntityConfig
    {
        $subResources = $entityConfig->getSubResourcesMap();
        return $this->importableEntityConfigFactory->create($subResources[$fieldName]);
    }


    /**
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    protected function fail(string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $this->line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
