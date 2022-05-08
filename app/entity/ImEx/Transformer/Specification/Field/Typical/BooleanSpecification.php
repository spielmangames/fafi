<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Specification\Field\Typical;

use FAFI\exception\FafiException;

class BooleanSpecification
{
    public const TRUE_FIELD = 'TRUE';
    public const FALSE_FIELD = 'FALSE';


    private const E_VALUE_NOT_BOOL = 'Property %s must be boolean.';


    /**
     * @param string $property
     * @param $value
     *
     * @return void
     * @throws FafiException
     */
    public function assertBool(string $property, $value): void
    {
        if (!is_bool($value)) {
            throw new FafiException(sprintf(self::E_VALUE_NOT_BOOL, $property));
        }
    }
}
