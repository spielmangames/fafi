<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

interface ImExEntitySpecification
{
    public function getResourceHydrator(): string;
    public function getFieldTransformersMap(): array;
    public function getFieldSpecificationsMap(): array;

    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;

    public function getResourceLoader(): string;
    public function getLoaderSubResources(): array;
}
