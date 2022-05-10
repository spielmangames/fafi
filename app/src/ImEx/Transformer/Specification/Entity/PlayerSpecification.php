<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

use FAFI\src\ImEx\Transformer\Field\Typical\BooleanFieldTransformer;
use FAFI\src\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\ImEx\Transformer\Schema\File\PlayerFileSchema;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
use FAFI\src\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PlayerSpecification implements ImExEntitySpecification
{
    public function getFieldSpecificationsMap(): array
    {
        return [
            PlayerFileSchema::ID => IntegerSpecification::class,

            PlayerFileSchema::NAME => StringSpecification::class,
            PlayerFileSchema::PARTICLE => StringSpecification::class,
            PlayerFileSchema::SURNAME => StringSpecification::class,
            PlayerFileSchema::FAFI_SURNAME => StringSpecification::class,

            PlayerFileSchema::HEIGHT => IntegerSpecification::class,
            PlayerFileSchema::FOOT => OneOfSpecification::class,
            PlayerFileSchema::INJURE_FACTOR => BooleanSpecification::class,
        ];
    }

    public function getFieldTransformersMap(): array
    {
        return [
            PlayerFileSchema::ID => IntegerFieldTransformer::class,

            PlayerFileSchema::NAME => StringFieldTransformer::class,
            PlayerFileSchema::PARTICLE => StringFieldTransformer::class,
            PlayerFileSchema::SURNAME => StringFieldTransformer::class,
            PlayerFileSchema::FAFI_SURNAME => StringFieldTransformer::class,

            PlayerFileSchema::HEIGHT => IntegerFieldTransformer::class,
//            PlayerFileSchema::FOOT => OneOfFieldTransformer::class,
            PlayerFileSchema::INJURE_FACTOR => BooleanFieldTransformer::class,
        ];
    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PlayerFileSchema::SURNAME,
            PlayerFileSchema::FOOT,
        ];
    }
}
