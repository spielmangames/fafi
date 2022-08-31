<?php

declare(strict_types=1);

namespace FAFI\src\FE\Themes\Printer\Custom\Player;

use FAFI\exception\FafiException;
use FAFI\exception\FrontErr;
use FAFI\src\FE\Themes\Printer\Basic\PageSections\AbstractTitle;

class PlayerTitle extends AbstractTitle
{
    protected bool $topBorder = true;
    protected bool $topPadding = true;
    protected bool $bottomPadding = true;
    protected bool $bottomBorder = false;


    private \FAFI\src\BE\Domain\Dto\Player\Player\Player $player;

    public function __construct(int $x, \FAFI\src\BE\Domain\Dto\Player\Player\Player $player)
    {
        parent::__construct($x);
        $this->player = $player;
    }


    /**
     * @return string
     * @throws FafiException
     */
    protected function prepareTitle(): string
    {
        if (!isset($this->player)) {
            throw new FafiException(sprintf(FrontErr::PLAYER_IS_MISSED, self::class));
        }
        /** @var \FAFI\src\BE\Domain\Dto\Player\Player\Player $player */
        $player = $this->player;

        return $player->buildFullName();
    }
}
