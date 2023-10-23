<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportTransformer
{
    private ImportConverter $importConverter;
    private ImportSpecificator $importSpecificator;
    private ImportMapper $importMapper;
    private ImportHydrator $importHydrator;

    public function __construct()
    {
        $this->importConverter = new ImportConverter();
        $this->importSpecificator = new ImportSpecificator();
        $this->importMapper = new ImportMapper();
        $this->importHydrator = new ImportHydrator();
    }


    /**
     * @param string[][] $extractedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return EntityDataInterface[]
     * @throws FafiException
     */
    public function transform(array $extractedRows, ImportableEntityConfig $entityConfig): array
    {
        $converted = $this->importConverter->convert($extractedRows, $entityConfig);
        $this->importSpecificator->validate($converted, $entityConfig);
        $mapped = $this->importMapper->map($converted, $entityConfig);

        return $this->importHydrator->hydrate($mapped, $entityConfig);
    }
}
