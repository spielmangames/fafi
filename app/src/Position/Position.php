<?php

namespace FAFI\src\Position;

use FAFI\src\Structure\EntityInterface;

class Position implements EntityInterface
{
    public const ENTITY = 'Position';


    public const P_GK = 'GK';

    public const P_CB = 'CB';
    public const P_RB = 'RB';
    public const P_LB = 'LB';
    public const P_WB = 'WB';

    public const P_DM = 'DM';
    public const P_CM = 'CM';
    public const P_AM = 'AM';

    public const P_RM = 'RM';
    public const P_LM = 'LM';
    public const P_WM = 'WM';

    public const P_RF = 'RF';
    public const P_LF = 'LF';
    public const P_WF = 'WF';

    public const P_SF = 'SF';
    public const P_CF = 'CF';

    public const P_SUPPORTED = [
        self::P_GK,

        self::P_CB,
        self::P_RB,
        self::P_LB,
        self::P_WB,

        self::P_DM,
        self::P_CM,
        self::P_AM,

        self::P_RM,
        self::P_LM,
        self::P_WM,

        self::P_RF,
        self::P_LF,
        self::P_WF,

        self::P_SF,
        self::P_CF,
    ];


    private ?int $id;
    protected ?string $name;


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
