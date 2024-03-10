<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegration;
use FAFI\src\BE\Domain\Persistence\Player\Integration\PlayerIntegrationDataHydrator;
use FAFI\src\BE\ImEx\Clients\PlayerIntegrationClient;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerIntegrationEntityFileSchema;
use FAFI\src\BE\ImEx\Schema\Mapper\PlayerIntegrationMapper;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\IntegerFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Field\Typical\StringFieldConverter;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\IdSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical\StringSpecification;

class PlayerIntegrationConfig implements ImportableEntityConfig
{
    public function getEntityName(): string
    {
        return PlayerIntegration::ENTITY;
    }


    public function getSubResourcesMap(): array
    {
        return [];
    }


    public function getFieldConvertersMap(): array
    {
        return [
            PlayerIntegrationEntityFileSchema::ID => IntegerFieldConverter::class,

//            PlayerIntegrationEntityFileSchema::PLAYER => PlayerFullNameToIdFieldConverter::class,
            PlayerIntegrationEntityFileSchema::TMARKT => StringFieldConverter::class,
        ];
    }

    public function getFieldSpecificationsMap(): array
    {
        return [
            PlayerIntegrationEntityFileSchema::ID => IdSpecification::class,

//            PlayerIntegrationEntityFileSchema::PLAYER => IdSpecification::class,
            PlayerIntegrationEntityFileSchema::TMARKT => StringSpecification::class,
        ];
    }

    public function getResourceMapper(): string
    {
        return PlayerIntegrationMapper::class;
    }

    public function getResourceDataHydrator(): string
    {
        return PlayerIntegrationDataHydrator::class;
    }


    public function getResourceLoader(): string
    {
        return PlayerIntegrationClient::class;
    }
}
