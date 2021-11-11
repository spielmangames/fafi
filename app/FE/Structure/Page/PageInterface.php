<?php

namespace FAFI\FE\Structure\Page;

use FAFI\FE\Structure\ContentableInterface;
use FAFI\FE\Structure\PageSection\BodyPageSectionInterface;
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
