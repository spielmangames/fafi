<?php

declare(strict_types=1);

namespace FAFI\demo;

use FAFI\db\Query\QuerySyntax;
use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Criteria;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\Player\Player\PlayerRepository;
use FAFI\src\BE\Domain\Persistence\Player\Position\PositionRepository;

class DemoPlayerRepo
{
    private PlayerRepository $playerRepo;
    private PositionRepository $positionRepo;

    public function __construct(PlayerRepository $playerRepo, PositionRepository $positionRepo)
    {
        $this->playerRepo = $playerRepo;
        $this->positionRepo = $positionRepo;
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


        $attr1 = new PlayerAttribute();
        $pos1 = $this->positionRepo->findByName('LB');
        $attr1->setPlayerId($player->getId())->setPositionId($pos1->getId())
            ->setDefMin(1)->setDefMax(2)->setAttMin(2)->setAttMax(2);

        $attr2 = new PlayerAttribute();
        $pos2 = $this->positionRepo->findByName('LM');
        $attr2->setPlayerId($player->getId())->setPositionId($pos2->getId())
            ->setDefMin(1)->setDefMax(1)->setAttMin(2)->setAttMax(3);

        $player->setAttributes([$attr1, $attr2]);
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
