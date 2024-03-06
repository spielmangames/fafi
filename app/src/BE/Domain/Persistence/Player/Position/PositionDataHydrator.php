<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Position;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Position\PositionData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class PositionDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return PositionData[]
     */
    public function hydrateCollection(array $data): array
    {
        return array_map(
            fn(array $row): PositionData => $this->hydrate($row),
            $data
        );


//        $hydrated = [];
//        foreach ($data as $row) {
//            $hydrated[] = $this->hydrate($row);
//        }
//
//        return $hydrated;
    }

    public function hydrate(array $data): PositionData
    {
        $positionData = new PositionData();

        return $positionData
            ->setId($data[PositionResource::ID_FIELD] ?? null)
            ->setName($data[PositionResource::NAME_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(PositionData::class, $entity);
        /** @var PositionData $entity */

        return [
            PositionResource::ID_FIELD => $entity->getId(),

            PositionResource::NAME_FIELD => $entity->getName(),
        ];
    }
}
