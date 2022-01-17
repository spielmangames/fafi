<?php

namespace FAFI\exception;

use Exception;

class FafiException extends Exception
{
    public const E_PLAYER_IS_MISSED = 'Player is required for %s.';
}
