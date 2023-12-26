<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Team\PlayerClub;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Team\PlayerClub\PlayerClub;
use FAFI\src\BE\Domain\Dto\Team\PlayerClub\PlayerClubConstraints;
use FAFI\src\BE\Domain\Dto\Team\PlayerClub\PlayerClubData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class PlayerClubResource extends AbstractResource
{
    private const TABLE = 'player_club_assocs';
    private const COLUMNS = [
        self::ID_FIELD,

        self::CLUB_ID_FIELD,
        self::NUM_FIELD,
        self::PLAYER_ID_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::CLUB_ID_FIELD,
        self::NUM_FIELD,
        self::PLAYER_ID_FIELD,
    ];
    private const UNIQUE_FIELDS = [];


    public const CLUB_ID_FIELD = 'club_id';
    public const NUM_FIELD = 'num';
    public const PLAYER_ID_FIELD = 'player_id';


    public function __construct()
    {
        parent::__construct(new PlayerClubHydrator(), new PlayerClubDataHydrator());
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
     * @return PlayerClub|null
     * @throws FafiException
     */
    public function read(array $conditions): ?PlayerClub
    {
        /** @var PlayerClub|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerClub[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var PlayerClub[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param PlayerClubData $entityData
     *
     * @return PlayerClub
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): PlayerClub
    {
        $this->entityValidator::assertEntityType(PlayerClubData::class, $entityData);

        /** @var PlayerClub $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param PlayerClubData $entityData
     *
     * @return PlayerClub
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): PlayerClub
    {
        $this->entityValidator::assertEntityType(PlayerClubData::class, $entityData);

        /** @var PlayerClub $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        if (isset($data[self::ID_FIELD])) {
            $field = self::ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }

        if (isset($data[self::CLUB_ID_FIELD])) {
            $field = self::CLUB_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }
        if (isset($data[self::NUM_FIELD])) {
            $field = self::NUM_FIELD;
            $this->entityValidator::assertEntityPropertyInt($data[$field], $field, PlayerClubConstraints::NUM_MIN, PlayerClubConstraints::NUM_MAX);
        }
        if (isset($data[self::PLAYER_ID_FIELD])) {
            $field = self::PLAYER_ID_FIELD;
            $this->entityValidator::assertEntityPropertyIdInt($data[$field], $field);
        }
    }
}
