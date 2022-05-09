<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

use FAFI\src\ImEx\Transformer\Schema\PositionFileSchema;

class PositionSpecification implements ImExEntitySpecification
{
    public function getFieldSpecifications(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }

//    public function getFieldTransformers(): array
//    {
//        return [];
//    }


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }
}
