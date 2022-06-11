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
     * [QC.Player.01] C(mandatory)+R + U(cross)+R + D+R
     *
     * @return void
     * @throws FafiException
     */
    public function demoModifyScenario(): void
    {
        $player = new Player();
        $player->setSurname('Sirginho')->setFafiSurname('Zerginho');

        $id = $this->playerRepo->save($player)->getId();
        $player = $this->playerRepo->findById($id);

        $player->setSurname('Serginho')->setHeight(181)->setFoot('L');
        $player = $this->playerRepo->save($player);
        $player = $this->playerRepo->findById($id);

        $this->playerRepo->deleteById($id);
        $player = $this->playerRepo->findById($id);
    }

    /**
     * [QC.Player.11] L(simple)
     *
     * @return void
     * @throws FafiException
     */
    public function demoListSimpleScenario(): void
    {
        // setup
        $ids = [];
        $player = new Player();
        $player->setSurname('Serginho')->setFafiSurname('Zerginho');
        $ids[] = $this->playerRepo->save($player)->getId();
        $player = new Player();
        $player->setName('Clarence')->setSurname('Seedorf')->setFafiSurname('Zeedorf');
        $ids[] = $this->playerRepo->save($player)->getId();
        $player = new Player();
        $player->setName('Jaap')->setSurname('Stam')->setFafiSurname('Steel');
        $ids[] = $this->playerRepo->save($player)->getId();


        // request A
        $players = $this->playerRepo->findCollection();

        // request B
        $condition = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IN, $ids);
        $selection = $this->playerRepo->findCollection([$condition]);

        // request C
        array_shift($ids);
        $condition = new Criteria(AbstractResource::ID_FIELD, QuerySyntax::OPERATOR_IN, $ids);
        $selection = $this->playerRepo->findCollection([$condition]);


        // teardown
        foreach ($ids as $id) {
            $this->playerRepo->deleteById($id);
        }
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
