<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Entity;

use FAFI\entity\ImEx\Transformer\Schema\PlayerFileSchema;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;
use FAFI\entity\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PlayerSpecification implements ImExEntitySpecification
{
    public function getFieldSpecifications(): array
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

//    public function getFieldTransformers(): array
//    {
//        return [];
//    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PlayerFileSchema::SURNAME,
            PlayerFileSchema::FOOT,
        ];
    }
}
