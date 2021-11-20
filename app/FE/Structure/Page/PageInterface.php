<?php

namespace FAFI\FE\Structure\Page;

use FAFI\FE\Structure\ContentableInterface;
use FAFI\FE\Structure\PageSection\BodyInterface;
use FAFI\FE\Structure\PageSection\FooterInterface;
use FAFI\FE\Structure\PageSection\HeaderInterface;
use FAFI\FE\Structure\PageSection\TitleInterface;

interface PageInterface extends ContentableInterface
{
    public function getTabsList(): array;
    public function initTab(string $tabName): self;

    public function getHeader(): HeaderInterface;
    public function getTitle(): TitleInterface;
    public function getBody(): BodyInterface;
    public function getFooter(): FooterInterface;
}
