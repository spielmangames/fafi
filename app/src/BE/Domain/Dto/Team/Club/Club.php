<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Team\Club;

use FAFI\src\BE\Domain\Dto\EntityInterface;
use FAFI\src\BE\Domain\Dto\Team\Team;

class Club extends Team implements EntityInterface
{
    public const ENTITY = 'Club';

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly ?string $fafiName,
        private readonly int $cityId,
        private readonly int $founded,
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

    public function getFafiName(): ?string
    {
        return $this->fafiName;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getFounded(): int
    {
        return $this->founded;
    }
}
