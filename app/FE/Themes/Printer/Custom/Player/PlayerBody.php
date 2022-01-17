<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\Basic\PageSections\AbstractBody;
use FAFI\FE\Themes\Printer\Basic\PageSections\TabsPanelWidget;

class PlayerBody extends AbstractBody
{
    protected bool $topBorder = false;
    protected bool $topPadding = false;
    protected bool $bottomPadding = false;
    protected bool $bottomBorder = false;


    private Player $player;

    public function __construct(int $x, int $yReserve, Player $player, string $tabName)
    {
        parent::__construct($x, $yReserve, $tabName);
        $this->player = $player;
    }

    public function setEntity(Player $player): self
    {
        $this->player = $player;
        return $this;
    }


    /**
     * @return string
     * @throws FafiException
     */
    protected function prepareContent(): string
    {
        if (!isset($this->player)) {
            throw new FafiException(sprintf(FafiException::E_PLAYER_IS_MISSED, self::class));
        }

        return $this->asdf($this->player);
    }

    private function asdf(Player $player): string
    {
        return '';
    }
}
