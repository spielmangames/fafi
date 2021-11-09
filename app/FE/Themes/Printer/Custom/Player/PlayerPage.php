<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;
use FAFI\FE\Themes\Printer\Basic\Pages\AbstractPrinterPage;
use FAFI\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class PlayerPage extends AbstractPrinterPage implements PageInterface
{
    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }


    public function getX(): int
    {
        return PD::PAGE_X_SIZE;
    }


    public function getHeader(): Header
    {
        return new Header($this->getX());
    }

    public function getTitle(): Title
    {
        $title = new PlayerTitle($this->getX());
        $title->setEntity($this->player);

        return $title;
    }

    public function getBody(): array
    {
        return [];
    }

    public function getFooter(): Footer
    {
        return new Footer($this->getX());
    }

    public function getContent(): string
    {
        $separator = PD::PAGE_Y_BORDER . EOL . PD::PAGE_Y_BORDER;
        $xBorder = PD::PAGE_XY_CORNER . $this->getPageBorder() . PD::PAGE_XY_CORNER;

        $header = implode($separator, $this->getHeader()->get());
        $title = implode($separator, $this->getTitle()->get());
        $body = implode($separator, $this->getBody());
        $footer = implode($separator, $this->getFooter()->get());

        $page = implode($separator, [$xBorder, $header, $title, $body, $footer, $xBorder]);
        return $page;
    }
}
