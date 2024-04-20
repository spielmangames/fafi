<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Import\Entity\Config\ImportableEntityConfigRetriever;
use FAFI\src\BE\ImEx\Import\ImportItem;

class ImportHydrator
{
    private ImportableEntityConfigRetriever $entityConfigRetriever;

    public function __construct()
    {
        $this->entityConfigRetriever = new ImportableEntityConfigRetriever();
    }


    /**
     * @param ImportItem[] $mappedItems
     *
     * @return ImportItem[]
     * @throws FafiException
     */
    public function execute(array $mappedItems): array
    {
        $hydrated = [];

        foreach ($mappedItems as $mappedItem) {
            $hydrated[] = $this->hydrateEntity($mappedItem);
        }

        return $hydrated;
    }


    /**
     * @param ImportItem $item
     *
     * @return EntityDataInterface
     * @throws FafiException
     */
    public function hydrateEntity(ImportItem $item): EntityDataInterface
    {
        $entityConfig = $item->getConfig();

        $resourceHydrator = $this->entityConfigRetriever->getResourceHydrator($entityConfig);

        return $resourceHydrator->hydrate($item->getMappedContent());
    }
}
