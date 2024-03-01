<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Player;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;

class Player implements EntityInterface
{
    use PlayerNameHelper;

    public const ENTITY = 'Player';

    public function __construct(
        private readonly int $id,
        private readonly ?string $name,
        private readonly ?string $particle,
        private readonly string $surname,
        private readonly ?string $fafiSurname,
        private readonly int $nationality,
        private readonly string $foot,
        private readonly int $height,
        private readonly bool $isFragile,
//        private readonly array $attributes,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function getParticle(): ?string
    {
        return $this->particle;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getFafiSurname(): ?string
    {
        return $this->fafiSurname;
    }


    public function getNationality(): int
    {
        return $this->nationality;
    }


    public function getFoot(): string
    {
        return $this->foot;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getIsFragile(): bool
    {
        return $this->isFragile;
    }


    /** @return PlayerAttribute[] */
    public function getAttributes(): array
    {
        return [];
//        return $this->attributes;
    }
}
