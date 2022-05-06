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


    public function getMandatoryFieldsOnCreate(): array
    {
        return [
            self::SURNAME,
            self::FOOT,
        ];
    }
}
