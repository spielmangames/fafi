<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

interface ImportableEntityConfig
{
    public function getEntityName(): string;


    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;
    /** @return string[] */
    public function getFieldTransformersMap(): array;
    /** @return string[] */
    public function getFieldSpecificationsMap(): array;


    public function getResourceHydrator(): string;
    /** @return string[] */
    public function getSubResourceHydrators(): array;
    public function getResourceLoader(): string;
    /** @return string[] */
    public function getSubResourceLoaders(): array;
}
