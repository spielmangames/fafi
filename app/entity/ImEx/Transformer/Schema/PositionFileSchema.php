<?php

namespace FAFI\entity\ImEx\Transformer\Schema;

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
