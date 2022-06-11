<?php

namespace FAFI\demo;

use FAFI\db\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\BE\Player\Repository\Criteria;
use FAFI\src\BE\Player\Repository\PlayerRepository;
use FAFI\src\BE\Player\Repository\PlayersFilter;
use FAFI\src\BE\Structure\Repository\AbstractResource;

class DemoPlayerRepo
{
    private PlayerRepository $playerRepo;

    public function __construct(PlayerRepository $playerRepo)
    {
        $this->playerRepo = $playerRepo;
    }


    /**
     * [QC.Player.01] C(mandatory)+R + U(full)+R + D+R
     *
     * @return void
     * @throws FafiException
     */
    public function demoModifyScenario(): void
    {
        $player = new Player();
        $player->setSurname('Serginho')->setFafiSurname('Zerginho');
        $id = $this->playerRepo->save($player)->getId();
        $selection = $this->playerRepo->findById($id);

        $player = $selection->setFoot('LEFTY');
        $selection = $this->playerRepo->save($player);
        $selection = $this->playerRepo->findById($id);

        $this->playerRepo->deleteById($id);
        $selection = $this->playerRepo->findById($id);
    }

    /**
     * [QC.Player.11] L(simple)
     *
     * @return void
     * @throws FafiException
     */
    public function demoListSimpleScenario(): void
    {
        $selection = $this->playerRepo->findCollection();

        $condition = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IN, [18, 19, 20]);
        $filter = new PlayersFilter([18, 19, 20]);
        $selection = $this->playerRepo->findCollection([$condition]);
    }

    /**
     * [QC.Player.12] L(advanced)
     *
     * @return void
     */
    public function demoListAdvancedScenario(): void
    {
//        'with: surname contains "Rose"' => new PlayersFilter(),
//        'with: att_min from 3 & def_min from 1 & def_min to 3' => new PlayersFilter(),
//        'with: att_min from 3 & def_min from 1 & position is CM & foot is R' => new PlayersFilter(),
//        'with: Nationality & age range' => new PlayersFilter(),
    }
}
