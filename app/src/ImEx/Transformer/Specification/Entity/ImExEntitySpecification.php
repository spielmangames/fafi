<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Entity;

interface ImExEntitySpecification
{
    public function getFieldSpecificationsMap(): array;

    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;
}
