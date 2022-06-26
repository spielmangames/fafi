<?php

namespace FAFI\src\BE\PlayerAttribute\Repository;

use FAFI\exception\FafiException;
use FAFI\src\BE\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Structure\EntityInterface;
use FAFI\src\BE\Structure\Repository\AbstractResource;
use FAFI\src\BE\Structure\Repository\EntityCriteriaInterface;

class PlayerAttributeResource extends AbstractResource
{
    private const TABLE = 'players_positions_assocs';
    public const COLUMNS = [
        self::ID_FIELD,

        self::PLAYER_ID_FIELD,
        self::POSITION_ID_FIELD,

        self::ATT_MIN_FIELD,
        self::ATT_MAX_FIELD,
        self::DEF_MIN_FIELD,
        self::DEF_MAX_FIELD,
    ];
    public const REQUIRED_FIELDS = [];
    public const UNIQUE_FIELDS = [];

    public const PLAYER_ID_FIELD = 'player_id';
    public const POSITION_ID_FIELD = 'position_id';

    public const ATT_MIN_FIELD = 'att_min';
    public const ATT_MAX_FIELD = 'att_max';
    public const DEF_MIN_FIELD = 'def_min';
    public const DEF_MAX_FIELD = 'def_max';


    protected PlayerAttributeHydrator $hydrator;

    public function __construct()
    {
        parent::__construct();
        $this->hydrator = new PlayerAttributeHydrator();
    }

    protected function getTable(): string
    {
        return self::TABLE;
    }

    protected function getRequiredFields(): array
    {
        return self::REQUIRED_FIELDS;
    }

    protected function getUniqueFields(): array
    {
        return self::UNIQUE_FIELDS;
    }


    /**
     * @param PlayerAttribute $entity
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function create($entity): PlayerAttribute
    {
        /** @var PlayerAttribute $result */
        $result = parent::create($entity);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var PlayerAttribute[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?PlayerAttribute
    {
        /** @var PlayerAttribute|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param PlayerAttribute $entity
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function update($entity): PlayerAttribute
    {
        /** @var PlayerAttribute $result */
        $result = parent::update($entity);

        return $result;
    }


    protected function verifyProperties(array $data): void
    {
        // to implement
    }
}
