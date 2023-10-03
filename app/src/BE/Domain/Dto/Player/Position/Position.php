<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Position;

use FAFI\src\BE\Domain\Dto\EntityInterface;

class Position implements EntityInterface
{
    public const ENTITY = 'Position';

    public function __construct(
        private readonly int $id,
        private readonly string $name,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }
}
