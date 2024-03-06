<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Specification\Field\Typical;

use FAFI\src\BE\ImEx\Transformer\Specification\Field\AbstractFieldSpecification;
use FAFI\src\BE\ImEx\Transformer\Specification\Field\FieldSpecification;

class EnumSpecification extends AbstractFieldSpecification implements FieldSpecification
{
    public const PARAM_SUPPORTED = 'supported';

    public array $supported;

    public function __construct(array $supported)
    {
        parent::__construct();

        $this->supported = $supported;
    }


    public function validate(string $property, $value): void
    {
        $this->dataValidator::assertFieldOneOf($value, $this->supported, $property);
    }
}
