<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

use FAFI\src\ImEx\Transformer\Schema\File\PositionFileSchema;

class PositionSpecification implements ImExEntitySpecification
{
    public function getFieldSpecificationsMap(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }
}