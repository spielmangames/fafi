<?php

namespace FAFI\src\BE\Player;

use FAFI\src\BE\PlayerAttribute\PlayerAttribute;
use FAFI\src\BE\Structure\EntityInterface;

class Player implements EntityInterface
{
    use PlayerDataHelperTrait;


    public const ENTITY = 'Player';


    // profile: basic
    private ?int $id = null;

    // personal: origin
    protected ?string $name = null;
    protected ?string $particle = null;
    protected ?string $surname = null;
    protected ?string $fafiSurname = null;
//    protected ?string $birthCountry;
//    protected ?string $birthCity;
//    protected ?string $birthDate;

    // skills: shape
    protected ?int $height = null;
    protected ?string $foot = null;
    protected ?bool $injureFactor = null;

    // skills: attributes per positions
    /** @var PlayerAttribute[]|null $attributes */
    protected ?array $attributes = null;


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

    public function setParticle(string $particle): self
    {
        $this->particle = $particle;
        return $this;
    }

    public function getParticle(): ?string
    {
        return $this->particle;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setFafiSurname(string $fafiSurname): self
    {
        $this->fafiSurname = $fafiSurname;
        return $this;
    }

    public function getFafiSurname(): ?string
    {
        return $this->fafiSurname;
    }


    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setFoot(string $foot): self
    {
        $this->foot = $foot;
        return $this;
    }

    public function getFoot(): ?string
    {
        return $this->foot;
    }

    public function setInjureFactor(bool $injureFactor): self
    {
        $this->injureFactor = $injureFactor;
        return $this;
    }

    public function getInjureFactor(): ?bool
    {
        return $this->injureFactor;
    }

    /**
     * @param PlayerAttribute[] $attributes
     *
     * @return Player
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }


    /** @return PlayerAttribute[]|null */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }


    public function __toString(): string
    {
        return self::ENTITY;
    }
}
