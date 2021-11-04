<?php

namespace FAFI\FE;

interface PageInterface
{
    public function getHeader(): array;
    public function getTitle(): array;
    public function getBody(): array;
    public function getFooter(): array;

    public function getContent(): string;
}
