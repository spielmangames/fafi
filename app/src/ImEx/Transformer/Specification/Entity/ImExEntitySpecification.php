<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

interface ImExEntitySpecification
{
    // nodes
    public const TRANSFORMER_CLASS = 'transformer';
    public const SPECIFICATION_CLASS = 'specification';
    public const CLASS_ARGS = 'args';


    public function getFieldTransformersMap(): array;
    public function getFieldSpecificationsMap(): array;

    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;
}
