<?php

namespace FAFI\entity\ImEx\Transformer;

class PositionFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            self::NAME,
        ];
    }
}
