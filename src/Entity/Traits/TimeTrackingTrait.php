<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimeTrackingTrait
{
    /**
     * Time of creation of this item.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Serialize]
    protected DateTimeImmutable $createdAt;

    /**
     * Time of modification of this item.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Serialize]
    protected DateTimeImmutable $modifiedAt;

    public function getCreatedAt(): DateTimeImmutable
    {
        if (false === isset($this->createdAt)) {
            $this->setCreatedAt(new DateTimeImmutable());
        }

        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): DateTimeImmutable
    {
        if (false === isset($this->modifiedAt)) {
            $this->setModifiedAt(new DateTimeImmutable());
        }

        return $this->modifiedAt;
    }

    public function setModifiedAt(DateTimeImmutable $modifiedAt): static
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }
}
