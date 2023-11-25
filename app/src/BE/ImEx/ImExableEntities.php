<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

interface ImExableEntities
{
    // geo
    public const COUNTRIES = 'countries';
    public const CITIES = 'cities';

    // team
    public const CLUBS = 'clubs';

    // player
    public const POSITIONS = 'positions';
    public const PLAYERS = 'players';
    public const PLAYER_ATTRIBUTES = 'player_attributes';
}
