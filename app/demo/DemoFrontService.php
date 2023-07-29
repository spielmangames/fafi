<?php

declare(strict_types=1);

namespace FAFI\demo;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerRepository;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayersFilter;
use FAFI\src\FE\StorefrontService;

class DemoFrontService
{
    private PlayerRepository $playerRepo;
    private StorefrontService $storefrontService;

    public function __construct(PlayerRepository $playerRepo, StorefrontService $storefrontService)
    {
        $this->playerRepo = $playerRepo;
        $this->storefrontService = $storefrontService;
    }


    /**
     * [QC.Player_Read.01] C(mandatory)+R + U(full)+R + D+R
     *
     * @return void
     * @throws FafiException
     */
    public function demoPlayerReadPage(): void
    {
        $condition = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IN, [18, 19, 20]);
        $filter = new PlayersFilter([18]);
        $players = $this->playerRepo->findCollection([$condition]);

        foreach ($players as $player) {
            $playerReadPage = $this->storefrontService->getPlayerReadPage($player->getId());

            foreach ($playerReadPage->getTabsList() as $tab) {
                $content = $playerReadPage->setTabName($tab)->forPrint();

                echo $content;
                echo EOL;
            }
            echo EOL;
        }
    }
}
