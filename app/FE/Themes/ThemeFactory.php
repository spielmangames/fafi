<?php

namespace FAFI\FE\Themes;

use FAFI\exception\FafiException;
use FAFI\FE\Themes\Printer\Printer;

class ThemeFactory
{
    public const THEME_PRINTER = 'Printer';


    /**
     * @param string $themeName
     * @return ThemeInterface
     * @throws FafiException
     */
    public function create(string $themeName): ThemeInterface
    {
        switch ($themeName) {
            case self::THEME_PRINTER:
                return new Printer();

            default:
                throw new FafiException(sprintf('Theme %s is not supported.', $themeName));
        }
    }
}
