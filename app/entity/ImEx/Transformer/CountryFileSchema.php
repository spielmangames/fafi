<?php

namespace FAFI\entity\ImEx\Transformer;

class CountryFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            self::NAME,
        ];
    }
}
