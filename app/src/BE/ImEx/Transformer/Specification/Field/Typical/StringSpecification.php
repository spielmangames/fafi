<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Specification\Field\AbstractFieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;

class StringSpecification extends AbstractFieldSpecification implements FieldSpecification
{
    public const PARAM_MIN = 'min';
    public const PARAM_MAX = 'max';

    private ?int $min;
    private ?int $max;

    public function __construct(?int $min = null, ?int $max = null)
    {
        parent::__construct();

        $this->min = $min;
        $this->max = $max;
    }


    public function validate(string $property, $value): void
    {
        $this->dataValidator::assertFieldStr($value, $property, $this->min, $this->max);
    }
}
