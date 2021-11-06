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


    public function getX(): int
    {
        return PD::PAGE_X_SIZE;
    }


    public function getHeader(): array
    {
        $sectionLimitX = $this->getX();
        $sectionLimitY = $this->getSectionY(
            PD::HEADER_Y_SIZE,
            PD::HEADER_TOP_BORDER,
            PD::HEADER_TOP_PADDING,
            PD::HEADER_BOTTOM_PADDING,
            PD::HEADER_BOTTOM_BORDER
        );

        $before = $this->fillBeforeSection(PD::HEADER_TOP_BORDER, PD::HEADER_TOP_PADDING);
        $inside = [];
        $after = $this->fillAfterSection(PD::HEADER_BOTTOM_PADDING, PD::HEADER_BOTTOM_BORDER, PD::HEADER_Y_SIZE);

        return array_merge($before, $inside, $after);
    }

    public function getTitle(): array
    {
        $sectionLimitX = $this->getX();
        $sectionLimitY = $this->getSectionY(
            PD::TITLE_Y_SIZE,
            PD::TITLE_TOP_BORDER,
            PD::TITLE_TOP_PADDING,
            PD::TITLE_BOTTOM_PADDING,
            PD::TITLE_BOTTOM_BORDER
        );

        $before = $this->fillBeforeSection(PD::TITLE_TOP_BORDER, PD::TITLE_TOP_PADDING);
        $inside = $this->alignCenter($this->buildFullName($this->player), $sectionLimitX, PD::PAGE_BASE);
        $after = $this->fillAfterSection(PD::TITLE_BOTTOM_PADDING, PD::TITLE_BOTTOM_BORDER, PD::TITLE_Y_SIZE);

        return array_merge($before, $inside, $after);
    }

    public function getBody(): array
    {
        return [];
    }

    public function getFooter(): array
    {
        $sectionLimitX = $this->getX();
        $sectionLimitY = $this->getSectionY(
            PD::FOOTER_Y_SIZE,
            PD::FOOTER_TOP_BORDER,
            PD::FOOTER_TOP_PADDING,
            PD::FOOTER_BOTTOM_PADDING,
            PD::FOOTER_BOTTOM_BORDER
        );

        $before = $this->fillBeforeSection(PD::FOOTER_TOP_BORDER, PD::FOOTER_TOP_PADDING);
        $inside = $this->alignCenter('FAFI  2021', $sectionLimitX, PD::PAGE_BASE);
        $after = $this->fillAfterSection(PD::FOOTER_BOTTOM_PADDING, PD::FOOTER_BOTTOM_BORDER, PD::FOOTER_Y_SIZE);

        return array_merge($before, $inside, $after);
    }

    public function getContent(): string
    {
        $separator = PD::PAGE_Y_BORDER . EL . PD::PAGE_Y_BORDER;

        $header = implode($separator, $this->getHeader());
        $title = implode($separator, $this->getTitle());
        $body = implode($separator, $this->getBody());
        $footer = implode($separator, $this->getFooter());

        return implode($separator, [$header, $title, $body, $footer]);
    }
}
