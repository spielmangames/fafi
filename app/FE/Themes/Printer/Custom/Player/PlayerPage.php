<?php

namespace FAFI\FE\Themes\Printer\Custom\Player;

use FAFI\entity\Player\Player;
use FAFI\FE\Structure\PageSection\BodyInterface;
use FAFI\FE\Structure\PageSection\FooterInterface;
use FAFI\FE\Structure\PageSection\HeaderInterface;
use FAFI\FE\Structure\PageSection\TitleInterface;
use FAFI\FE\Themes\Printer\Basic\Pages\AbstractPrinterPage;
use FAFI\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\FE\Themes\Printer\PrinterDesign as PD;

class PlayerPage extends AbstractPrinterPage
{
    public const TAB_PROFILE = 'profile';
    public const TAB_ORIGIN = 'origin';
    public const TAB_SKILLS = 'skills';
    private const TABS_LIST = [
        self::TAB_PROFILE,
        self::TAB_ORIGIN,
        self::TAB_SKILLS,
    ];


    private HeaderInterface $header;
    private TitleInterface $title;
    private BodyInterface $body;
    private FooterInterface $footer;


    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }


    public function getTabsList(): array
    {
        return self::TABS_LIST;
    }


    public function getX(): int
    {
        return PD::PAGE_X_SIZE;
    }

    public function getY(): int
    {
        return PD::PAGE_Y_SIZE;
    }


    public function getHeader(): HeaderInterface
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

    public function getTitle(): TitleInterface
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

    public function getBody(): BodyInterface
    {
        if(!isset($this->body)) {
            $this->setBody();
        }

        return $this->body;
    }

    private function setBody(): void
    {
        $this->body = new PlayerBody($this->getX(), $this->calcBodyYReserve(), $this->player, $this->tabName);
    }

    public function getFooter(): FooterInterface
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


    public function getContent(): array
    {
//        if (!isset($this->tabName)) {
//            throw new FafiException(sprintf('Tab is not set for %s.', self::class));
//        }

        $separator = PD::PAGE_Y_BORDER . EOL . PD::PAGE_Y_BORDER;
        $xBorder = PD::PAGE_XY_CORNER . $this->getPageBorder() . PD::PAGE_XY_CORNER;

        $header = implode($separator, $this->getHeader()->getContent());
        $title = implode($separator, $this->getTitle()->getContent());
        $body = implode($separator, $this->getBody()->getContent());
        $footer = implode($separator, $this->getFooter()->getContent());

        $page = implode($separator, [$xBorder, $header, $title, $body, $footer, $xBorder]);
        return $page;
    }
}
