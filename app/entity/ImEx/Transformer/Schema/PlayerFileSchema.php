<?php

namespace FAFI\entity\ImEx\Transformer\Schema;

class PlayerFileSchema extends AbstractFileSchema
{
    public const NAME = 'name';
    public const PARTICLE = 'particle';
    public const SURNAME = 'surname';
    public const FAFI_SURNAME = 'fafi_surname';

    public const HEIGHT = 'height';
    public const FOOT = 'foot';
    public const INJURE_FACTOR = 'injure_factor';


    public const FILE_HEADER = [
        self::ID,

        self::NAME,
        self::PARTICLE,
        self::SURNAME,
        self::FAFI_SURNAME,

        self::HEIGHT,
        self::FOOT,
        self::INJURE_FACTOR,
    ];


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            self::SURNAME,
            self::FOOT,
        ];
    }
}
