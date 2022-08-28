<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Entity;

use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

interface ImportableEntity
{
    public function getSpecification(): ImportableEntityConfig;
}
