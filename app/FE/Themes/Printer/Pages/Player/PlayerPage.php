<?php

namespace FAFI\FE\Themes\Printer\Pages\Player;

use FAFI\entity\Player\Player;
use FAFI\FE\PageInterface;

class PlayerPage implements PageInterface
{
    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }


    public function getHeader()
    {
        // TODO: Implement getHeader() method.
    }

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    public function getFooter()
    {
        // TODO: Implement getFooter() method.
    }
}
