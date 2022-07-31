<?php

namespace FAFI\src\FE\Themes\Printer\Basic\Widgets;

use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\FE\Themes\Printer\Basic\PageSections\AbstractWidget;
use FAFI\src\FE\Themes\Printer\PrinterDesign as PD;

/**
 * OQ :: Options qty (0 < OQ < 5)
 * OL :: Option name length (= 2)
 * DSQ :: axle Delimiter sections qty (= OQ + 1)
 * DL :: single Delimiter length (= 1)
 * DSL :: length of axle Delimiter section (multiple by DL)
 * X :: axle length
 *
 * X = (OQ * OL) + (DSQ * DSL)
 */
class PlayerAttributesWidget extends AbstractWidget
{
    protected int $x = 22;
    protected int $yReserve = -1;

    protected bool $topBorder = false;
    protected bool $topPadding = true;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


    private int $attributesQtyLimitMin = 1;
    private int $attributesQtyLimitMax = 4;


    private Player $player;

    public function __construct($player)
    {
        parent::__construct($this->x, $this->yReserve);

        $this->player = $player;
    }


    public function getInside(): array
    {
        return [$this->alignLeft($this->prepareW($this->player), $this->getX(), PD::PAGE_X_BORDER)];
    }

    private function prepareW(Player $player)
    {
        $attributes = $player->getAttributes();

        $zzz = 1;
    }
}
