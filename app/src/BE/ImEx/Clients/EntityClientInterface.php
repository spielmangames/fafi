<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityInterface;

interface EntityClientInterface
{
    public function create($entity): EntityInterface;
    public function update($entity): EntityInterface;
}
