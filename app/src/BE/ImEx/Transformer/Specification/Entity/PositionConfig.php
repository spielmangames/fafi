<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\ImEx\Persistence\Client\PositionClient;
use FAFI\src\BE\ImEx\Persistence\Hydrator\PositionHydrator;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldTransformer;
use FAFI\src\BE\ImEx\Transformer\Schema\File\PositionFileSchema;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IntegerSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PositionConfig implements ImportableEntityConfig
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
            PositionFileSchema::ID => IntegerSpecification::class,

            PositionFileSchema::NAME => StringSpecification::class,
        ];
    }

    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            PositionFileSchema::NAME,
        ];
    }


    public function getResourceHydrator(): string
    {
        return PositionHydrator::class;
    }

    public function getSubResourceHydrators(): array
    {
        return [];
    }

    public function getResourceLoader(): string
    {
        return PositionClient::class;
    }

    public function getSubResourceLoaders(): array
    {
        return [];
    }
}
