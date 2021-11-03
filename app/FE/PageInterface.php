<?php

namespace FAFI\FE;

interface PageInterface
{
    public function getHeader();
    public function getTitle();
    public function getBody();
    public function getFooter();
}
