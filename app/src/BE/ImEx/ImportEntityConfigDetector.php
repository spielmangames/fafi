<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx;

use FAFI\exception\FafiException;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\CityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ClubConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\CountryConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfigFactory;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PlayerAttributeConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PlayerConfig;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\PositionConfig;

class ImportEntityConfigDetector
{
    private const MAP = [
        ImExableEntities::COUNTRIES => CountryConfig::class,
        ImExableEntities::CITIES => CityConfig::class,

        ImExableEntities::CLUBS => ClubConfig::class,

        ImExableEntities::POSITIONS => PositionConfig::class,
        ImExableEntities::PLAYERS => PlayerConfig::class,
        ImExableEntities::PLAYER_ATTRIBUTES => PlayerAttributeConfig::class,
    ];


    private ImportableEntityConfigFactory $importableEntityConfigFactory;

    public function __construct()
    {
        $this->importableEntityConfigFactory = new ImportableEntityConfigFactory();
    }


    /**
     * @param string $filePath
     *
     * @return ImportableEntityConfig
     * @throws FafiException
     */
    public function selectConfig(string $filePath): ImportableEntityConfig
    {
        $entity = pathinfo($filePath, PATHINFO_FILENAME);
        return $this->importableEntityConfigFactory->create(self::MAP[$entity]);
    }
}
