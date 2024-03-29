<?php

declare(strict_types=1);

namespace FAFI\src\FE\Themes;

use FAFI\exception\FafiException;
use FAFI\src\FE\Themes\Printer\Printer;

class ThemeFactory
{
    public const THEME_PRINTER = 'Printer';

    private const E_THEME_NOT_SUPPORTED = 'Theme %s is not supported.';

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
        }

        throw new FafiException(sprintf(self::E_THEME_NOT_SUPPORTED, $themeName));
    }
}
