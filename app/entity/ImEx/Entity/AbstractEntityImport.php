<?php

namespace FAFI\entity\ImEx\Entity;

use FAFI\entity\ImEx\Transformer\Schema\AbstractFileSchema;
use FAFI\entity\ImEx\Transformer\Specification\Entity\ImExEntitySpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\ImExFieldSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\ImExFieldSpecificationFactory;
use FAFI\entity\Player\Player;
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
}
