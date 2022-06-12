<?php

namespace FAFI\demo;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Player\Repository\PlayerRepository;
use FAFI\src\BE\Player\Repository\PlayersFilter;
use FAFI\src\BE\Structure\Repository\AbstractResource;
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
            $playerReadPage = $this->storefrontService->getPlayerReadPage($player);

            foreach ($playerReadPage->getTabsList() as $tab) {
                $content = $playerReadPage->setTabName($tab)->forPrint();

                echo $content;
                echo EOL;
            }
            echo EOL;
        }
    }
}
