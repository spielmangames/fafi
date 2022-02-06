<?php

namespace FAFI\entity\Player;

use FAFI\entity\PlayerAttribute\PlayerAttribute;

class Player
{
    use PlayerDataHelperTrait;


    public const ENTITY = 'Player';


    // profile: basic
    private ?int $id;

    // personal: origin
    protected ?string $name;
    protected ?string $particle;
    protected ?string $surname;
    protected ?string $fafiSurname;
//    protected ?string $birthCountry;
//    protected ?string $birthCity;
//    protected ?string $birthDate;

    // skills: shape
    protected ?int $height;
    protected ?string $foot;
    protected ?bool $injureFactor;

    // skills: attributes per positions
    /** @var PlayerAttribute[]|null $attributes */
    protected ?array $attributes;


    public function __construct(
        ?int $id,
        ?string $name,
        ?string $particle,
        ?string $surname,
        ?string $fafiName,
//        ?string $birthCountry,
//        ?string $birthCity,
//        ?string $birthDate,
        ?int $height,
        ?string $foot,
        ?bool $injureFactor,
        ?array $attributes
    ) {
        $this->id = $id;

        $this->name = $name;
        $this->particle = $particle;
        $this->surname = $surname;
        $this->fafiSurname = $fafiName;
//        $this->birthCountry = $birthCountry;
//        $this->birthCity = $birthCity;
//        $this->birthDate = $birthDate;

        $this->height = $height;
        $this->foot = $foot;
        $this->injureFactor = $injureFactor;

        $this->attributes = $attributes;
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

//    public function setBirthCountry(string $birthCountry): self
//    {
//        $this->birthCountry = $birthCountry;
//        return $this;
//    }
//
//    public function getBirthCountry(): ?string
//    {
//        return $this->birthCountry;
//    }
//
//    public function setBirthCity(string $birthCity): self
//    {
//        $this->birthCity = $birthCity;
//        return $this;
//    }
//
//    public function getBirthCity(): ?string
//    {
//        return $this->birthCity;
//    }
//
//    public function setBirthDate(string $birthDate): self
//    {
//        $this->birthDate = $birthDate;
//        return $this;
//    }
//
//    public function getBirthDate(): ?string
//    {
//        return $this->birthDate;
//    }


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
}
