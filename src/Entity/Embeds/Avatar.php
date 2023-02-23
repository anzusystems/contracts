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
    private string $avatarColor = '';

    #[ORM\Column(type: Types::STRING, length: 3)]
    #[Assert\AtLeastOneOf([
        new Assert\Blank(),
        new Assert\Length(min: 2, max: 3),
    ])]
    #[Serialize]
    private string $avatarText = '';

    public function getAvatarColor(): string
    {
        return $this->avatarColor;
    }

    public function setAvatarColor(string $avatarColor): self
    {
        $this->avatarColor = $avatarColor;

        return $this;
    }

    public function getAvatarText(): string
    {
        return $this->avatarText;
    }

    public function setAvatarText(string $avatarText): self
    {
        $this->avatarText = $avatarText;

        return $this;
    }
}
