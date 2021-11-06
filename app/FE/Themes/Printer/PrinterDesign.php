<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\FE\DesignHelper;

class PrinterDesign
{
    public const PAGE_BASE = ' ';

    // page
    public const PAGE_X_SIZE = 32;
    public const PAGE_X_BORDER = '-';
    public const PAGE_Y_SIZE = 32;
    public const PAGE_Y_BORDER = '|';

    // sections
    public const HEADER_Y_SIZE = 1;
    public const HEADER_TOP_BORDER = false;
    public const HEADER_TOP_PADDING = false;
    public const HEADER_BOTTOM_PADDING = false;
    public const HEADER_BOTTOM_BORDER = false;

    public const TITLE_Y_SIZE = 4;
    public const TITLE_TOP_BORDER = true;
    public const TITLE_TOP_PADDING = true;
    public const TITLE_ALIGN = DesignHelper::ALIGN_CENTER;
    public const TITLE_BOTTOM_PADDING = true;
    public const TITLE_BOTTOM_BORDER = false;

//    public const BODY_TABS_Y_SIZE = 1;
//    public const BODY_TABS_BASE = self::PAGE_X_BORDER;
//    public const BODY_TABS_ACTIVE_LEFT_BORDER = self::PAGE_Y_BORDER;
//    public const BODY_TABS_ACTIVE_RIGHT_BORDER = self::PAGE_Y_BORDER;
//    public const BODY_TABS_PASSIVE_SIZE = 2;
//    public const BODY_TABS_PASSIVE_LEFT_BORDER = self::NONE;
//    public const BODY_TABS_PASSIVE_RIGHT_BORDER = self::NONE;
//    public const BODY_TABS_PASSIVE_PADDING_SIZE = 1;
//    public const BODY_TABS_OUTER_PADDING_SIZE = 1;
//
//    public const BODY_WIDGETS_X_TOP_BORDER = self::PAGE_BASE;
//    public const BODY_WIDGETS_X_BOTTOM_BORDER = self::PAGE_BASE;

    public const FOOTER_Y_SIZE = 2;
    public const FOOTER_TOP_BORDER = false;
    public const FOOTER_TOP_PADDING = true;
    public const FOOTER_ALIGN = DesignHelper::ALIGN_CENTER;
    public const FOOTER_BOTTOM_PADDING = false;
    public const FOOTER_BOTTOM_BORDER = false;
}
