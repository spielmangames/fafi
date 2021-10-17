<?php

namespace FAFI\entity\Player;

class Player
{
    // profile basic
    protected string $fafiName;
    protected bool $status;

    // personal origin
    protected string $name;
    protected string $particle;
    protected string $surname;
    protected string $birthCountry;
    protected string $birthCity;
    protected string $birthDate;

    // skills shape
    protected int $height;
    protected string $foot;
    protected bool $injureFactor;

    // skills attributes
    protected array $attributes;


    public function setFafiName(string $fafiName): self
    {
        $this->fafiName = $fafiName;
        return $this;
    }

    public function getFafiName(): string
    {
        return $this->fafiName;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setParticle(string $particle): self
    {
        $this->particle = $particle;
        return $this;
    }

    public function getParticle(): string
    {
        return $this->particle;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setBirthCountry(string $birthCountry): self
    {
        $this->birthCountry = $birthCountry;
        return $this;
    }

    public function getBirthCountry(): string
    {
        return $this->birthCountry;
    }

    public function setBirthCity(string $birthCity): self
    {
        $this->birthCity = $birthCity;
        return $this;
    }

    public function getBirthCity(): string
    {
        return $this->birthCity;
    }

    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }


    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setFoot(string $foot): self
    {
        $this->foot = $foot;
        return $this;
    }

    public function getFoot(): string
    {
        return $this->foot;
    }

    public function setInjureFactor(bool $injureFactor): self
    {
        $this->injureFactor = $injureFactor;
        return $this;
    }

    public function getInjureFactor(): bool
    {
        return $this->injureFactor;
    }


    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
