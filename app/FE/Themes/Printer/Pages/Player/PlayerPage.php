<?php

namespace FAFI\FE\Themes\Printer\Pages\Player;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;
use FAFI\FE\Themes\Printer\AbstractPrinterPage;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class PlayerPage extends AbstractPrinterPage implements PageInterface
{
    private int $x;


    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }


    private function setX(): void
    {
        $this->x = PD::PAGE_X_SIZE - (strlen(PD::PAGE_Y_BORDER) * 2);
    }

    public function getX(): int
    {
        if(!isset($this->x)) {
            $this->setX();
        }

        return $this->x;
    }


    public function getHeader(): array
    {
        $sectionLimitX = $this->getX();
        $sectionLimitY = $this->getSectionY(PD::HEADER_Y_SIZE, PD::HEADER_TOP_BORDER, PD::HEADER_BOTTOM_BORDER);

        $header = [];
        for ($y = 1; $y <= $sectionLimitY; $y++) {
            $header[$y] = $this->getGeneratedLine($sectionLimitX, PD::PAGE_BASE);
        }

        $header[] = $this->getGeneratedLine($sectionLimitX, PD::HEADER_BOTTOM_BORDER);

        return $header;
    }

    public function getTitle(): array
    {
        return [];
    }

    public function getBody(): array
    {
        return [];
    }

    public function getFooter(): array
    {
        return [];
    }

    public function getContent(): string
    {
        $header = $this->getHeader();
        $title = $this->getTitle();
        $body = $this->getBody();
        $footer = $this->getFooter();

        return '';
    }
}
