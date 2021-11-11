<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;

class PlayerTitle extends Title
{
    protected int $yReserve = 4;
    protected bool $topBorder = true;
    protected bool $topPadding = true;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


    private Player $player;

    public function __construct(int $x, Player $player)
    {
        parent::__construct($x);
        $this->player = $player;
    }


    /**
     * @return string
     * @throws FafiException
     */
    protected function prepareContent(): string
    {
        if (!isset($this->player)) {
            throw new FafiException('Player is required.');
        }
        /** @var Player $player */
        $player = $this->player;

        return $player->buildPlayerFullName();
    }
}
