<?php

namespace FAFI\src\FE\Themes\Printer\Custom\Player;

use FAFI\exception\FafiException;
use FAFI\exception\FrontErr;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\FE\Structure\ContentableInterface;
use FAFI\src\FE\Structure\PageSection\PageSectionInterface;
use FAFI\src\FE\Themes\Printer\Basic\Pages\AbstractPrinterPage;
use FAFI\src\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\src\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\src\FE\Themes\Printer\PrinterDesign as PD;

class PlayerPage extends AbstractPrinterPage
{
    public const TAB_PROFILE = 'profile';
    public const TAB_ORIGIN = 'origin';
    public const TAB_SKILLS = 'skills';
    public const TABS_LIST = [
        self::TAB_PROFILE,
        self::TAB_ORIGIN,
        self::TAB_SKILLS,
    ];


    private PageSectionInterface $header;
    private PageSectionInterface $title;
    private PageSectionInterface $body;
    private PageSectionInterface $footer;


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


    public function getHeader(): PageSectionInterface
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

    public function getTitle(): PageSectionInterface
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

    public function getBody(): PageSectionInterface
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

    public function getFooter(): PageSectionInterface
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


    /**
     * @return array
     * @throws FafiException
     */
    public function getContent(): array
    {
        if (!isset($this->tabName)) {
            throw new FafiException(sprintf(FrontErr::TAB_NOT_SET, self::class));
        }

        $separator = PD::PAGE_Y_BORDER . EOL . PD::PAGE_Y_BORDER;
        $xBorder = PD::PAGE_XY_CORNER . $this->getPageBorder() . PD::PAGE_XY_CORNER;

        $header = $this->wrap($this->getHeader(), $separator);
        $title = $this->wrap($this->getTitle(), $separator);
        $body = $this->wrap($this->getBody(), $separator);
        $footer = $this->wrap($this->getFooter(), $separator);

        $page = implode($separator, [$xBorder, $header, $title, $body, $footer, $xBorder]);
        return $page;
    }

    public function wrap(ContentableInterface $block, string $separator): string
    {
        return implode($separator, $block->getContent());
    }


    public function forPrint(): string
    {
        $separator = PD::PAGE_Y_BORDER . EOL . PD::PAGE_Y_BORDER;

        return $this->wrap($this, $separator);
    }
}
