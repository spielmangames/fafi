<?php

namespace FAFI\entity\ImEx\Transformer\Schema;

class CountryFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
    ];


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            self::NAME,
        ];
    }
}
