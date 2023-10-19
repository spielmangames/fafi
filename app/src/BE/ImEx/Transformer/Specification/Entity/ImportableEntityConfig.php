<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Entity;

interface ImportableEntityConfig
{
    public function getEntityName(): string;


    /** @return string[] */
    public function getFieldConvertersMap(): array;
    /** @return string[] */
    public function getFieldSpecificationsMap(): array;
    public function getResourceMapper(): string;
    public function getResourceDataHydrator(): string;
    /** @return string[] */
    public function getSubResourceDataHydrators(): array;

    public function getResourceLoader(): string;
    /** @return string[] */
    public function getSubResourceLoaders(): array;
}
