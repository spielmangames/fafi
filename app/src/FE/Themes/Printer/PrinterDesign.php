<?php

namespace FAFI\src\FE\Themes\Printer;

use FAFI\src\FE\DesignHelper;

class PrinterDesign
{
    public const PAGE_BASE = ' ';

    // page
    public const PAGE_X_SIZE = 32;
    public const PAGE_X_BORDER = '-';
    public const PAGE_Y_SIZE = 32;
    public const PAGE_Y_BORDER = '|';
    public const PAGE_XY_CORNER = '+';

    // sections
    public const TITLE_ALIGN = DesignHelper::ALIGN_CENTER;

    public const BODY_TABS_Y_SIZE = 1;
    public const BODY_TABS_BASE = self::PAGE_X_BORDER;
    public const BODY_TABS_ACTIVE_LEFT_BORDER = self::PAGE_Y_BORDER;
    public const BODY_TABS_ACTIVE_RIGHT_BORDER = self::PAGE_Y_BORDER;
    public const BODY_TABS_PASSIVE_SIZE = 2;
    public const BODY_TABS_PASSIVE_LEFT_BORDER = false;
    public const BODY_TABS_PASSIVE_RIGHT_BORDER = false;
    public const BODY_TABS_PASSIVE_PADDING_SIZE = 1;
    public const BODY_TABS_OUTER_PADDING_SIZE = 1;

    public const BODY_WIDGETS_X_TOP_BORDER = self::PAGE_BASE;
    public const BODY_WIDGETS_X_BOTTOM_BORDER = self::PAGE_BASE;

    public const FOOTER_ALIGN = DesignHelper::ALIGN_CENTER;
}
