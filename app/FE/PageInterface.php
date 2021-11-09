<?php

namespace FAFI\FE;

use FAFI\FE\Themes\Printer\Basic\PageSections\Footer;
use FAFI\FE\Themes\Printer\Basic\PageSections\Header;
use FAFI\FE\Themes\Printer\Basic\PageSections\Title;

interface PageInterface
{
    public function getHeader(): Header;
    public function getTitle(): Title;
    public function getBody(): array;
    public function getFooter(): Footer;

    public function getContent(): string;
}
