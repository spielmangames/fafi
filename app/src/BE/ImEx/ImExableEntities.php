<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

interface ImExableEntities
{
    // geo
    public const GROUP_GEO = 'geo';
    public const COUNTRIES = 'countries';
    public const CITIES = 'cities';

    // team
    public const GROUP_TEAM = 'team';
    public const CLUBS = 'clubs';

    // player
    public const GROUP_PLAYER = 'player';
    public const POSITIONS = 'positions';
    public const PLAYERS = 'players';
    public const PLAYER_ATTRIBUTES = 'player_attributes';


    // https://docs.google.com/spreadsheets/d/1jW637_G4hjuMGt9b3f44bjh0yl02jgMfh7wDB9-8AYo/edit#gid=730816347
    public const TO_DO = '_todo';
}
