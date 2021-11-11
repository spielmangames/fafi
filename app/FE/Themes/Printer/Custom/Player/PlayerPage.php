<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;
use FAFI\FE\Themes\Printer\Basic\Pages\AbstractPrinterPage;
use FAFI\FE\Themes\Printer\Basic\PageSections\Body;
use FAFI\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class PlayerPage extends AbstractPrinterPage implements PageInterface
{
    private Header $header;
    private Title $title;
    private Body $body;
    private Footer $footer;


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
        if(!isset($this->header)) {
            $this->setHeader();
        }

        return $this->header;
    }

    private function setHeader(): void
    {
        $this->header = new Header($this->getX());
    }

    public function getTitle(): Title
    {
        if(!isset($this->title)) {
            $this->setTitle();
        }

        return $this->title;
    }

    private function setTitle(): void
    {
        $this->title = new PlayerTitle($this->getX(), $this->player);
    }

    public function getBody(): Body
    {
        if(!isset($this->body)) {
            $this->setBody();
        }

        return $this->body;
    }

    private function setBody(): void
    {
        $this->body = new PlayerBody($this->getX(), $this->calcBodyYReserve(), $this->player);
    }

    public function getFooter(): Footer
    {
        if(!isset($this->footer)) {
            $this->setFooter();
        }

        return $this->footer;
    }

    private function setFooter(): void
    {
        $this->footer = new Footer($this->getX());
    }


    public function getContent(): string
    {
        $separator = PD::PAGE_Y_BORDER . EOL . PD::PAGE_Y_BORDER;
        $xBorder = PD::PAGE_XY_CORNER . $this->getPageBorder() . PD::PAGE_XY_CORNER;

        $header = implode($separator, $this->getHeader()->get());
        $title = implode($separator, $this->getTitle()->get());
        $body = implode($separator, $this->getBody()->get());
        $footer = implode($separator, $this->getFooter()->get());

        $page = implode($separator, [$xBorder, $header, $title, $body, $footer, $xBorder]);
        return $page;
    }
}
