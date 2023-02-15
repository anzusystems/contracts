<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait CustomDataTrait
{
    /**
     * Custom data..
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    protected array $customData;

    public function getCustomData(): array
    {
        return $this->customData;
    }

    public function setCustomData(array $customData): static
    {
        $this->customData = $customData;

        return $this;
    }
}
