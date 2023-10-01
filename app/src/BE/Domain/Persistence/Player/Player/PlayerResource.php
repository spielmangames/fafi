<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Player;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\Player\Player\Player;
use FAFI\src\BE\Domain\Dto\Player\Player\PlayerConstraints;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class PlayerResource extends AbstractResource
{
    private const TABLE = 'players';
    private const COLUMNS = [
        self::ID_FIELD,

        self::NAME_FIELD,
        self::PARTICLE_FIELD,
        self::SURNAME_FIELD,
        self::FAFI_SURNAME_FIELD,
//        self::BIRTH_COUNTRY_FIELD,
//        self::BIRTH_CITY_FIELD,
//        self::BIRTH_DATE_FIELD,

        self::HEIGHT_FIELD,
        self::FOOT_FIELD,
        self::INJURE_FACTOR_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::SURNAME_FIELD,
        self::FAFI_SURNAME_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::FAFI_SURNAME_FIELD,
    ];


    // personal origin
    public const NAME_FIELD = 'name';
    public const PARTICLE_FIELD = 'particle';
    public const SURNAME_FIELD = 'surname';
    public const FAFI_SURNAME_FIELD = 'fafi_surname';
//    public const BIRTH_COUNTRY_FIELD = 'birth_country';
//    public const BIRTH_CITY_FIELD = 'birth_city';
//    public const BIRTH_DATE_FIELD = 'birth_date';

    // skills shape
    public const HEIGHT_FIELD = 'height';
    public const FOOT_FIELD = 'foot';
    public const INJURE_FACTOR_FIELD = 'injure_factor';


    public function __construct()
    {
        parent::__construct(new PlayerHydrator());
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
     * @param Player $entityData
     *
     * @return Player
     * @throws FafiException
     */
    public function create($entityData): Player
    {
        /** @var Player $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player[]|null
     * @throws FafiException
     */
    public function read(array $conditions = []): ?array
    {
        /** @var Player[]|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return Player|null
     * @throws FafiException
     */
    public function readFirst(array $conditions): ?Player
    {
        /** @var Player|null $result */
        $result = parent::readFirst($conditions);

        return $result;
    }

    /**
     * @param Player $entityData
     *
     * @return Player
     * @throws FafiException
     */
    public function update($entityData): Player
    {
        /** @var Player $result */
        $result = parent::update($entityData);

        return $result;
    }


    protected function verifyModelPropertiesConstraints(array $data): void
    {
        if (isset($data[self::NAME_FIELD])) {
            $field = self::NAME_FIELD;
            $this->entityValidator->assertEntityPropertyStr($data[$field], $field, PlayerConstraints::NAME_MIN, PlayerConstraints::NAME_MAX);
        }
        if (isset($data[self::PARTICLE_FIELD])) {
            $field = self::PARTICLE_FIELD;
            $this->entityValidator->assertEntityPropertyStr($data[$field], $field, PlayerConstraints::PARTICLE_MIN, PlayerConstraints::PARTICLE_MAX);
        }
        if (isset($data[self::SURNAME_FIELD])) {
            $field = self::SURNAME_FIELD;
            $this->entityValidator->assertEntityPropertyStr($data[$field], $field, PlayerConstraints::SURNAME_MIN, PlayerConstraints::SURNAME_MAX);
        }
        if (isset($data[self::FAFI_SURNAME_FIELD])) {
            $field = self::FAFI_SURNAME_FIELD;
            $this->entityValidator->assertEntityPropertyStr($data[$field], $field, PlayerConstraints::FAFI_SURNAME_MIN, PlayerConstraints::FAFI_SURNAME_MAX);
        }

        if (isset($data[self::HEIGHT_FIELD])) {
            $field = self::HEIGHT_FIELD;
            $this->entityValidator->assertEntityPropertyInt($data[$field], $field, PlayerConstraints::HEIGHT_MIN, PlayerConstraints::HEIGHT_MAX);
        }
        if (isset($data[self::FOOT_FIELD])) {
            $field = self::FOOT_FIELD;
            $this->entityValidator->assertEntityPropertyEnum($data[$field], $field, PlayerConstraints::FOOT_SUPPORTED);
        }
    }

//    public function patch(int $playerId, array $fieldValues): int
//    {
//        return $this->connection->table(self::TABLE)
//            ->where(self::ID_FIELD, '=', $playerId)
//            ->update($fieldValues);
//    }
//
//    public function count(PlayerCriteria $criteria): int
//    {
//        $query = $this->connection->table(self::TABLE);
//
//        if (!$criteria->isEmpty()) {
//            $this->formWhere($criteria);
//        }
//
//        return $query->count();
//    }
}
