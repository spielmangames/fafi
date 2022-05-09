<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Entity;

use FAFI\src\ImEx\Transformer\Schema\AbstractFileSchema;
use FAFI\src\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;
use FAFI\src\Player\Player;
use FAFI\exception\FafiException;
use FAFI\ImEx\Extractor\ImportExtractor;
use FAFI\ImEx\Transformer\ImportTransformer;

abstract class AbstractEntityImport
{
    protected ImportExtractor $importExtractor;
    protected ImportTransformer $importTransformer;

    public function __construct()
    {
        $this->importExtractor = new ImportExtractor();
        $this->importTransformer = new ImportTransformer();
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
        $transformed = $this->importTransformer->transform($extracted, $this->entitySpecification);
        $this->load($transformed);
    }
}
