<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Transformer\Field\Player;

use FAFI\src\BE\Domain\Service\PlayerService;
use FAFI\src\BE\ImEx\Transformer\Field\ImportFieldConverter;

class PositionNameToIdFieldConverter implements ImportFieldConverter
{
    private PlayerService $service;

    public function __construct()
    {
        $this->service = new PlayerService();
    }


    public function fromStr(string $property, string $value): ?int
    {
        return $this->service->findPositionByName($value)?->getId();
    }
}
