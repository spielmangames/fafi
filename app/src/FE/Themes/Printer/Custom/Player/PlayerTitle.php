<?php

namespace FAFI\src\FE\Themes\Printer\Custom\Player;

use FAFI\exception\FafiException;
use FAFI\src\BE\Player\Player;
use FAFI\src\FE\Themes\Printer\Basic\PageSections\AbstractTitle;

class PlayerTitle extends AbstractTitle
{
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
    protected function prepareTitle(): string
    {
        if (!isset($this->player)) {
            throw new FafiException(sprintf(FafiException::E_PLAYER_IS_MISSED, self::class));
        }
        /** @var Player $player */
        $player = $this->player;

        return $player->buildPlayerFullName();
    }
}