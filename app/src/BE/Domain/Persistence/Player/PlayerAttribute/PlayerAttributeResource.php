<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeConstraints;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttributeData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class PlayerAttributeResource extends AbstractResource
{
    private const TABLE = 'players_positions_assocs';
    private const COLUMNS = [
        self::ID_FIELD,

        self::PLAYER_ID_FIELD,
        self::POSITION_ID_FIELD,

        self::ATT_MIN_FIELD,
        self::ATT_MAX_FIELD,
        self::DEF_MIN_FIELD,
        self::DEF_MAX_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::PLAYER_ID_FIELD,
        self::POSITION_ID_FIELD,

        self::ATT_MIN_FIELD,
        self::ATT_MAX_FIELD,
        self::DEF_MIN_FIELD,
        self::DEF_MAX_FIELD,
    ];
    private const UNIQUE_FIELDS = [];


    public const PLAYER_ID_FIELD = 'player_id';
    public const POSITION_ID_FIELD = 'position_id';

    public const ATT_MIN_FIELD = 'att_min';
    public const ATT_MAX_FIELD = 'att_max';
    public const DEF_MIN_FIELD = 'def_min';
    public const DEF_MAX_FIELD = 'def_max';


    public function __construct()
    {
        parent::__construct(new PlayerAttributeHydrator(), new PlayerAttributeDataHydrator());
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
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute|null
     * @throws FafiException
     */
    public function read(array $conditions): ?PlayerAttribute
    {
        /** @var PlayerAttribute|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerAttribute[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var PlayerAttribute[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param PlayerAttributeData $entityData
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): PlayerAttribute
    {
        $this->entityValidator::assertEntityType(PlayerAttributeData::class, $entityData);

        /** @var PlayerAttribute $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param PlayerAttributeData $entityData
     *
     * @return PlayerAttribute
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): PlayerAttribute
    {
        $this->entityValidator::assertEntityType(PlayerAttributeData::class, $entityData);

        /** @var PlayerAttribute $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        if (isset($data[self::ID_FIELD])) {
            $field = self::ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }

        if (isset($data[self::PLAYER_ID_FIELD])) {
            $field = self::PLAYER_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }
        if (isset($data[self::POSITION_ID_FIELD])) {
            $field = self::POSITION_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }

        if (isset($data[self::ATT_MIN_FIELD])) {
            $field = self::ATT_MIN_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, PlayerAttributeConstraints::ATT_MIN_MIN, PlayerAttributeConstraints::ATT_MIN_MAX);
        }
        if (isset($data[self::ATT_MAX_FIELD])) {
            $field = self::ATT_MAX_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, PlayerAttributeConstraints::ATT_MAX_MIN, PlayerAttributeConstraints::ATT_MAX_MAX);
        }
        if (isset($data[self::DEF_MIN_FIELD])) {
            $field = self::DEF_MIN_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, PlayerAttributeConstraints::DEF_MIN_MIN, PlayerAttributeConstraints::DEF_MIN_MAX);
        }
        if (isset($data[self::DEF_MAX_FIELD])) {
            $field = self::DEF_MAX_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, PlayerAttributeConstraints::DEF_MAX_MIN, PlayerAttributeConstraints::DEF_MAX_MAX);
        }
    }
}
