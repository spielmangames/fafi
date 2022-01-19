<?php

namespace FAFI\FE\Structure\Page;

use FAFI\FE\Structure\ContentableInterface;
use FAFI\FE\Structure\PrintableInterface;
use FAFI\FE\Structure\PageSection\PageSectionInterface;

interface PageInterface extends ContentableInterface, PrintableInterface
{
    public function getTabsList(): array;
    public function setTabName(string $tabName): self;

    public function getHeader(): PageSectionInterface;
    public function getTitle(): PageSectionInterface;
    public function getBody(): PageSectionInterface;
    public function getFooter(): PageSectionInterface;
}
