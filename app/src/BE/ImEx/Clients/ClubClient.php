<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Clients;

use FAFI\src\BE\Domain\Dto\Team\Club\Club;
use FAFI\src\BE\Domain\Service\TeamService;

class ClubClient implements EntityClientInterface
{
    private TeamService $teamService;

    public function __construct()
    {
        $this->teamService = new TeamService();
    }


    public function create($entity): Club
    {
        return $this->teamService->saveClub($entity);
    }

    public function update($entity): Club
    {
        return $this->teamService->saveClub($entity);
    }
}
