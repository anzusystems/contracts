<?php

namespace AnzuSystems\Contracts\Entity\Embeds;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Embeddable]
class Avatar
{
    #[ORM\Column(type: Types::STRING, length: 6)]
    #[Assert\CssColor(formats: Assert\CssColor::HEX_LONG)]
    #[Serialize]
    private string $color = '';

    #[ORM\Column(type: Types::STRING, length: 3)]
    #[Assert\AtLeastOneOf([
        new Assert\Blank(),
        new Assert\Length(min: 2, max: 3),
    ])]
    #[Serialize]
    private string $text = '';

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
