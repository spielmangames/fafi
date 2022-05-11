<?php

declare(strict_types=1);

namespace FAFI\BE\ImEx\Transformer\Specification\Entity;

interface ImExEntitySpecification
{
    public function getFieldTransformersMap(): array;
    public function getFieldSpecificationsMap(): array;

    /** @return string[] */
    public function getMandatoryFieldsOnCreate(): array;
}
