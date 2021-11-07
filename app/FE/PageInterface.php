<?php

namespace FAFI\FE;

use FAFI\FE\Themes\Printer\Footer;
use FAFI\FE\Themes\Printer\Header;

interface PageInterface
{
    public function getHeader(): Header;
    public function getTitle(): array;
    public function getBody(): array;
    public function getFooter(): Footer;

    public function getContent(): string;
}
