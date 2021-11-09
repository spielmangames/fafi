<?php

namespace FAFI\FE;

use FAFI\FE\Themes\Printer\Basic\Sections\Footer;
use FAFI\FE\Themes\Printer\Basic\Sections\Header;
use FAFI\FE\Themes\Printer\Basic\Sections\Title;

interface PageInterface
{
    public function getHeader(): Header;
    public function getTitle(): Title;
    public function getBody(): array;
    public function getFooter(): Footer;

    public function getContent(): string;
}
