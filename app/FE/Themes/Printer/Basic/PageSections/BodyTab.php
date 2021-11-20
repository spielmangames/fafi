<?php

namespace FAFI\FE\Themes\Printer\Basic\PageSections;

use FAFI\FE\Structure\PageSection\BodyTabInterface;

class BodyTab extends AbstractPrinterPageSection implements BodyTabInterface
{
    public function getWidgets(): array
    {
        return [];
    }

    public function getInside(): array
    {
        // TODO: Implement getInside() method.
    }
}
