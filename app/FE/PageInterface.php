<?php

namespace FAFI\FE;

use FAFI\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;

interface PageInterface extends ContentableInterface
{
    public function getHeader(): Header;
    public function getTitle(): Title;
    public function getBody(): BodyPageSectionInterface;
    public function getFooter(): Footer;
}
