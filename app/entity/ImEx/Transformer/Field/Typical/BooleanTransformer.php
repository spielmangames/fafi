<?php

declare(strict_types=1);

namespace FAFI\entity\ImEx\Transformer\Field\Typical;

use FAFI\entity\ImEx\Transformer\Field\Specification\Typical\BooleanSpecification;
use FAFI\exception\FafiException;

class BooleanTransformer
{
    private BooleanSpecification $booleanSpecification;

    public function __construct()
    {
        $this->booleanSpecification = new BooleanSpecification();
    }


    /**
     * @param string $property
     * @param string $value
     *
     * @return bool
     * @throws FafiException
     */
    public function fromStr(string $property, string $value): bool
    {
        switch ($value) {
            case BooleanSpecification::TRUE_FIELD:
                $value = true;
                break;
            case BooleanSpecification::FALSE_FIELD:
                $value = false;
                break;
        }

        $this->booleanSpecification->assertBool($property, $value);

        return $value;
    }
}
