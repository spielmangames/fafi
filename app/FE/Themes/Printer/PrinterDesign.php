<?php

namespace FAFI\FE\Themes\Printer;

use FAFI\FE\DesignHelper;

class PrinterDesign
{
    // page frame:
    public const PAGE_X_SIZE = 34;
    public const PAGE_X_BORDER = '-';
    public const PAGE_Y_SIZE = 32;
    public const PAGE_Y_BORDER = '|';
    public const PAGE_BASE = ' ';


    // page sections:
    public const HEADER_Y_SIZE = 2;
    public const HEADER_TOP_BORDER = '';
    public const HEADER_BOTTOM_BORDER = '-';

    public const TITLE_Y_SIZE = 3;
    public const TITLE_TOP_BORDER = self::PAGE_BASE;
    public const TITLE_BOTTOM_BORDER = self::PAGE_BASE;
    public const TITLE_ALIGN = DesignHelper::ALIGN_CENTER;

    public const BODY_TABS_Y_SIZE = 1;
    public const BODY_TABS_BASE = '-';
    public const BODY_TABS_ACTIVE_LEFT_BORDER = '{';
    public const BODY_TABS_ACTIVE_RIGHT_BORDER = '}';
    public const BODY_TABS_PASSIVE_SIZE = 2;
    public const BODY_TABS_PASSIVE_LEFT_BORDER = '';
    public const BODY_TABS_PASSIVE_RIGHT_BORDER = '';
    public const BODY_TABS_PASSIVE_PADDING_SIZE = 2;
    public const BODY_TABS_OUTER_PADDING_SIZE = 1;

    public const BODY_WIDGETS_X_TOP_BORDER = self::PAGE_BASE;
    public const BODY_WIDGETS_X_BOTTOM_BORDER = self::PAGE_BASE;

    public const FOOTER_Y_SIZE = 1;
    public const FOOTER_ALIGN = DesignHelper::ALIGN_CENTER;
}
