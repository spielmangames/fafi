<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

interface ImExEntitySpecification
{
    public function getFieldTransformersMap(): array;
    public function getFieldSpecificationsMap(): array;
    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;

    public function getResourceHydrator(): string;
    /** @return string[] */
    public function getSubResourceHydrators(): array;
    public function getResourceLoader(): string;
    /** @return string[] */
    public function getSubResourceLoaders(): array;
}
