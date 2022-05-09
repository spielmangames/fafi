<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

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

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PlayerFileSchema::SURNAME,
            PlayerFileSchema::FOOT,
        ];
    }
}
