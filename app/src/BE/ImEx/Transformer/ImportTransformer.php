<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer;

use FAFI\exception\FafiException;
use FAFI\exception\ImExErr;
use FAFI\src\BE\ImEx\Import\ImportItem;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportTransformer
{
    private ImportConverter $importConverter;
    private ImportSpecificator $importSpecificator;

    public function __construct()
    {
        $this->importConverter = new ImportConverter();
        $this->importSpecificator = new ImportSpecificator();
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
            $transformed = array_map(
                fn(int $line, array $row): ImportItem => $this->transformRow($line, $row, $entityConfig),
                $extractedRows
            );
//            foreach ($extractedRows as $line => $extractedRow) {
//                $transformed[] = $this->transformRow($line, $extractedRow, $entityConfig);
//            }
        } catch (FafiException $exception) {
            $this->fail($line, $exception->getMessage());
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

    /**
     * @param int $line
     * @param string $error
     *
     * @return void
     * @throws FafiException
     */
    private function fail(int $line, string $error): void
    {
        $e = [sprintf(ImExErr::IMPORT_FAILED, $line), $error];
        throw new FafiException(FafiException::combine($e));
    }
}
