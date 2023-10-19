<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\Club;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubData;
use FAFI\src\BE\Domain\Persistence\EntityDataHydratorInterface;
use FAFI\src\BE\Domain\Persistence\EntityValidator;

class ClubDataHydrator implements EntityDataHydratorInterface
{
    /**
     * @param array $data
     *
     * @return ClubData[]
     */
    public function hydrateCollection(array $data): array
    {
        $hydrated = [];
        foreach ($data as $row) {
            $hydrated[] = $this->hydrate($row);
        }

        return $hydrated;
    }

    public function hydrate(array $data): ClubData
    {
        $clubData = new ClubData();

        return $clubData
            ->setId($data[ClubResource::ID_FIELD] ?? null)
            ->setName($data[ClubResource::NAME_FIELD] ?? null)
            ->setFafiName($data[ClubResource::FAFI_NAME_FIELD] ?? null)
            ->setCityId($data[ClubResource::CITY_ID_FIELD] ?? null)
            ->setFounded($data[ClubResource::FOUNDED_FIELD] ?? null);
    }

    public function dehydrate(EntityDataInterface $entity): array
    {
        EntityValidator::assertEntityType(ClubData::class, $entity);
        /** @var ClubData $entity */

        return [
            ClubResource::ID_FIELD => $entity->getId(),

            ClubResource::NAME_FIELD => $entity->getName(),
            ClubResource::FAFI_NAME_FIELD => $entity->getFafiName(),
            ClubResource::CITY_ID_FIELD => $entity->getCityId(),
            ClubResource::FOUNDED_FIELD => $entity->getFounded(),
        ];
    }
}
