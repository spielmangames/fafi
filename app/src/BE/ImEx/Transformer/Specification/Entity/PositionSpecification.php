<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PositionFileSchema;

class PositionSpecification implements ImExEntitySpecification
{
    public function getFieldTransformersMap(): array
    {
        return [
            PositionFileSchema::ID => IntegerFieldTransformer::class,

            PositionFileSchema::NAME => StringFieldTransformer::class,
        ];
    }

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
