<?php

declare(strict_types=1);

namespace FAFI\src\BE\ImEx\Import;

use FAFI\src\BE\Domain\Dto\EntityDataInterface;
use FAFI\src\BE\ImEx\Transformer\Specification\Entity\ImportableEntityConfig;

class ImportItem
{
//    private ?int $id;

    private array $convertedContent;
    private array $mappedContent;
    private EntityDataInterface $hydratedContent;

    private array $subItems = [];


    public function __construct(
        private readonly int $line,
        private readonly ImportableEntityConfig $config,
    ) {
    }


    public function getLine(): int
    {
        return $this->line;
    }

    public function getConfig(): ImportableEntityConfig
    {
        return $this->config;
    }


//    public function setId(?int $id): self
//    {
//        $this->id = $id;
//        return $this;
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//
    public function setConvertedContent(array $convertedContent): self
    {
        $this->convertedContent = $convertedContent;
        return $this;
    }

    public function getConvertedContent(): array
    {
        return $this->convertedContent;
    }

    public function cleanupConvertedContent(): self
    {
        $this->convertedContent = [];
        return $this;
    }

    public function setMappedContent(array $mappedContent): self
    {
        $this->mappedContent = $mappedContent;
        return $this;
    }

    public function getMappedContent(): array
    {
        return $this->mappedContent;
    }

    public function cleanupMappedContent(): self
    {
        $this->mappedContent = [];
        return $this;
    }

    public function setHydratedContent(EntityDataInterface $hydratedContent): self
    {
        $this->hydratedContent = $hydratedContent;
        return $this;
    }

    public function getHydratedContent(): EntityDataInterface
    {
        return $this->hydratedContent;
    }

//    public function cleanupHydratedContent(): self
//    {
//        $this->hydratedContent = null;
//        return $this;
//    }


    /**
     * @param ImportItem[] $subItems
     * @return $this
     */
    public function addSubItems(array $subItems): self
    {
        $this->subItems = array_merge($this->subItems, $subItems);
        return $this;
    }

    /**
     * @param ImportItem[] $subItems
     * @return $this
     */
    public function setSubItems(array $subItems): self
    {
        $this->subItems = $subItems;
        return $this;
    }

    /** @return ImportItem[] */
    public function getSubItems(): array
    {
        return $this->subItems;
    }
}
