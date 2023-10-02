<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\PlayerAttribute;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\PlayerAttribute\PlayerAttribute;
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
    private const REQUIRED_FIELDS = [];
    private const UNIQUE_FIELDS = [];


    public const PLAYER_ID_FIELD = 'player_id';
    public const POSITION_ID_FIELD = 'position_id';

    public const ATT_MIN_FIELD = 'att_min';
    public const ATT_MAX_FIELD = 'att_max';
    public const DEF_MIN_FIELD = 'def_min';
    public const DEF_MAX_FIELD = 'def_max';


    public function __construct()
    {
        parent::__construct(new PlayerAttributeHydrator());
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
        $this->entityValidator::verifyInterface(PlayerAttributeData::class, $entityData);

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
        $this->entityValidator::verifyInterface(PlayerAttributeData::class, $entityData);

        /** @var PlayerAttribute $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        // to implement
    }
}
