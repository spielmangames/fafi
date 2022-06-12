<?php

namespace FAFI\exception;

interface FrontErr extends Err
{
    public const TAB_NOT_SET = 'Tab is not set for %s.';
    public const TAB_NOT_SUPPORTED = 'Tab "%s" is not supported for %s.';

    public const PLAYER_IS_MISSED = 'Player is required for %s.';
}
