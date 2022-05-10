<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Specification\Field\Player;

use FAFI\src\ImEx\Transformer\Specification\Field\Typical\OneOfSpecification;

class PlayerFootSpecification extends OneOfSpecification
{
    public const LEFT = 'L';
    public const RIGHT = 'R';

    public array $allowed = [
        self::LEFT,
        self::RIGHT,
    ];
}
