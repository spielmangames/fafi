<?php

declare(strict_types=1);

namespace FAFI\src\BE\Domain\Persistence\Player\Integration;

use FAFI\exception\FafiException;
use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegration;
use FAFI\src\BE\Domain\Dto\Player\Integration\PlayerIntegrationData;
use FAFI\src\BE\Domain\Persistence\AbstractResource;
use FAFI\src\BE\Domain\Persistence\EntityCriteriaInterface;

class PlayerIntegrationResource extends AbstractResource
{
    private const TABLE = 'player_integrations';
    private const COLUMNS = [
        self::ID_FIELD,

        self::PLAYER_ID_FIELD,
        self::TMARKT_FIELD,
    ];
    private const REQUIRED_FIELDS = [
        self::PLAYER_ID_FIELD,
        self::TMARKT_FIELD,
    ];
    private const UNIQUE_FIELDS = [
        self::PLAYER_ID_FIELD,
        self::TMARKT_FIELD,
    ];


    public const PLAYER_ID_FIELD = 'player_id';
    public const TMARKT_FIELD = 'tmarkt';


    public function __construct()
    {
        parent::__construct(new PlayerIntegrationHydrator(), new PlayerIntegrationDataHydrator());
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
     * @return PlayerIntegration|null
     * @throws FafiException
     */
    public function read(array $conditions): ?PlayerIntegration
    {
        /** @var PlayerIntegration|null $result */
        $result = parent::read($conditions);

        return $result;
    }

    /**
     * @param EntityCriteriaInterface[] $conditions
     *
     * @return PlayerIntegration[]
     * @throws FafiException
     */
    public function list(array $conditions = []): array
    {
        /** @var PlayerIntegration[] $result */
        $result = parent::list($conditions);

        return $result;
    }


    /**
     * @param PlayerIntegrationData $entityData
     *
     * @return PlayerIntegration
     * @throws FafiException
     */
    public function create(EntityDataInterface $entityData): PlayerIntegration
    {
        $this->entityValidator::assertEntityType(PlayerIntegrationData::class, $entityData);

        /** @var PlayerIntegration $result */
        $result = parent::create($entityData);

        return $result;
    }

    /**
     * @param PlayerIntegrationData $entityData
     *
     * @return PlayerIntegration
     * @throws FafiException
     */
    public function update(EntityDataInterface $entityData): PlayerIntegration
    {
        $this->entityValidator::assertEntityType(PlayerIntegrationData::class, $entityData);

        /** @var PlayerIntegration $result */
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
        if (isset($data[self::TMARKT_FIELD])) {
            $field = self::TMARKT_FIELD;
            $this->entityValidator::assertEntityPropertyStr($data[$field], $field);
        }
    }
}
