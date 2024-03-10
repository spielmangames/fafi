<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Player;

use FAFI\src\BE\Domain\Persistence\DataValidator;
use FAFI\src\BE\ImEx\Schema\FileSchema\Entity\PlayerIntegrationEntityFileSchema;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class PlayerIntegrationsFieldConverter implements ImportFieldConverter
{
    private DataValidator $dataValidator;

    public function __construct()
    {
        $this->dataValidator = new DataValidator();
    }


    public function fromStr(string $property, string $value): array
    {
        $converted = [$property => $value];
        $this->validatePlayerIntegration($converted);

        return [$converted];
    }


    private function validatePlayerIntegration(array $integration): void
    {
        foreach ($integration as $field => $value) {
            $this->dataValidator::assertFieldOneOf($field, PlayerIntegrationEntityFileSchema::HEADER);
            $this->dataValidator::assertFieldStr($value);
        }
    }
}
