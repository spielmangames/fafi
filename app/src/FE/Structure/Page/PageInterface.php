<?php

declare(strict_types=1);

namespace FAFI\src\FE\Structure\Page;

use FAFI\src\FE\Structure\ContentableInterface;
use FAFI\src\FE\Structure\PageSection\PageSectionInterface;
use FAFI\src\FE\Structure\PrintableInterface;

interface PageInterface extends ContentableInterface, PrintableInterface
{
    public function getTabsList(): array;
    public function setTabName(string $tabName): self;

    public function getHeader(): PageSectionInterface;
    public function getTitle(): PageSectionInterface;
    public function getBody(): PageSectionInterface;
    public function getFooter(): PageSectionInterface;
}
