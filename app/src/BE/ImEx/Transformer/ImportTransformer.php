<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Import\Fail\ImportFailurer;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportTransformer
{
    private ImportConverter $importConverter;
    private ImportSpecificator $importSpecificator;
    private ImportFailurer $importFailurer;

    public function __construct()
    {
        $this->importConverter = new ImportConverter();
        $this->importSpecificator = new ImportSpecificator();
        $this->importFailurer = new ImportFailurer();
    }


    /**
     * @param string[][] $extractedRows
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImportItem[]
     * @throws FafiException
     */
    public function transform(array $extractedRows, ImportableEntityConfig $entityConfig): array
    {
        $transformed = [];

        try {
            foreach ($extractedRows as $line => $extractedRow) {
                $transformed[] = $this->transformRow($line, $extractedRow, $entityConfig);
            }
        } catch (FafiException $exception) {
            $this->importFailurer->fail($line, $exception->getMessage());
        }

        return $transformed;
    }

    /**
     * @param int $line
     * @param string[] $extractedRow
     * @param ImportableEntityConfig $entityConfig
     *
     * @return ImportItem
     * @throws FafiException
     */
    private function transformRow(int $line, array $extractedRow, ImportableEntityConfig $entityConfig): ImportItem
    {
        $item = $this->importConverter->convertEntity($line, $extractedRow, $entityConfig);
        $this->importSpecificator->validateEntity($item);

        return $item;
    }
}
