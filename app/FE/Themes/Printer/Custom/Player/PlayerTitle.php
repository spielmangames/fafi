<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;

class PlayerTitle extends Title
{
    private Player $player;

    protected int $yReserve = 4;
    protected bool $topBorder = true;
    protected bool $topPadding = true;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


    public function __construct(int $x)
    {
        parent::__construct($x);
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
            throw new FafiException('Player is required.');
        }

        return $this->buildPlayerFullName($this->player);
    }

    private function buildPlayerFullName(Player $player): string
    {
        $fullName = [];

        $name = $player->getName();
        if ($name) {
            $fullName[] = $name;
        }

        $particle = $player->getParticle();
        if ($particle) {
            $fullName[] = $particle;
        }

        $fullName[] = $player->getSurname();

        return implode(' ', $fullName);
    }
}
