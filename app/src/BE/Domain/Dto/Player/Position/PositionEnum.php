<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Dto\Player\Position;

final class PositionEnum
{
    public const GK = 'GK';

    public const CB = 'CB';

    public const RB = 'RB';
    public const LB = 'LB';
    public const WB = 'WB';

    public const DM = 'DM';
    public const CM = 'CM';
    public const AM = 'AM';

    public const RM = 'RM';
    public const LM = 'LM';
    public const WM = 'WM';

    public const RF = 'RF';
    public const LF = 'LF';
    public const WF = 'WF';

    public const SF = 'SF';
    public const CF = 'CF';


    public const SUPPORTED = [
        self::GK,

        self::CB,

        self::RB,
        self::LB,
        self::WB,

        self::DM,
        self::CM,
        self::AM,

        self::RM,
        self::LM,
        self::WM,

        self::RF,
        self::LF,
        self::WF,

        self::SF,
        self::CF,
    ];
}
