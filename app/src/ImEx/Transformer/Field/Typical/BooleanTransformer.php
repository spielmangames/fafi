<?php

declare(strict_types=1);

namespace FAFI\src\ImEx\Transformer\Field\Typical;

use FAFI\src\ImEx\Transformer\Specification\Field\Typical\BooleanSpecification;
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

//        $this->booleanSpecification->validate($property, $value);

        return $value;
    }
}
