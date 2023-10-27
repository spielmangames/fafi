<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Dto\Team\Club\ClubData;
use FAFI\src\BE\Domain\Service\TeamService;

class ClubClient implements EntityClientInterface
{
    private TeamService $teamService;

    public function __construct()
    {
        $this->teamService = new TeamService();
    }


    public function save(EntityDataInterface $entity): Club
    {
        /** @var ClubData $entity */
        return $this->teamService->saveClub($entity);
    }
}
