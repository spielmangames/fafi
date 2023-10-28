<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Service;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;
use FAFI\src\BE\Domain\Persistence\Team\Club\ClubRepository;

class TeamService implements ServiceInterface
{
    private ClubRepository $clubRepository;

    public function __construct()
    {
        $this->clubRepository = new ClubRepository();
    }


    /**
     * @param int $id
     *
     * @return Club|null
     * @throws FafiException
     */
    public function findClubById(int $id): ?Club
    {
        return $this->clubRepository->findById($id);
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Club[]
     * @throws FafiException
     */
    public function findClubsCollection(array $conditions): array
    {
        return $this->clubRepository->findCollection($conditions);
    }

    /**
     * @param Club $club
     *
     * @return Club
     * @throws FafiException
     */
    public function saveClub(Club $club): Club
    {
        return $this->clubRepository->save($club);
    }
}
