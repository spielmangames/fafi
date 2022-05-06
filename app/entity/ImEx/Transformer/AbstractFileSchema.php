<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer;

abstract class AbstractFileSchema
{
    public const ID = 'id';


    /** @return string[] */
    abstract public function getMandatoryFieldsOnCreate(): array;
}
