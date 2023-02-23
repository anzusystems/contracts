<?php

namespace AnzuSystems\Contracts\Entity\Embeds;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Embeddable]
class Person
{
    #[ORM\Column(type: Types::STRING, length: 120)]
    #[Assert\AtLeastOneOf([
        new Assert\Blank(),
        new Assert\Length(min: 2, max: 120),
    ])]
    #[Serialize]
    private string $personFirstName = '';

    #[ORM\Column(type: Types::STRING, length: 120)]
    #[Assert\AtLeastOneOf([
        new Assert\Blank(),
        new Assert\Length(min: 2, max: 120),
    ])]
    #[Serialize]
    private string $personLastName = '';

    #[ORM\Column(type: Types::STRING, length: 240)]
    #[Assert\AtLeastOneOf([
        new Assert\Blank(),
        new Assert\Length(min: 3, max: 242),
    ])]
    #[Serialize]
    private string $personFullName = '';

    public function getPersonFirstName(): string
    {
        return $this->personFirstName;
    }

    public function setPersonFirstName(string $personFirstName): self
    {
        $this->personFirstName = $personFirstName;

        return $this;
    }

    public function getPersonLastName(): string
    {
        return $this->personLastName;
    }

    public function setPersonLastName(string $personLastName): self
    {
        $this->personLastName = $personLastName;

        return $this;
    }

    public function getPersonFullName(): string
    {
        return $this->personFullName;
    }

    public function setPersonFullName(string $personFullName): self
    {
        $this->personFullName = $personFullName;

        return $this;
    }
}
