<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use AnzuSystems\Contracts\Entity\Interfaces\BaseIdentifiableInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait IdentityBigIntTrait
{
    use NamedResourceTrait;

    /**
     * Primary key of this item.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    #[Serialize]
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function is(BaseIdentifiableInterface $identifiable): bool
    {
        if ($identifiable::getResourceName() === $this->getResourceName()) {
            return $identifiable->getId() === $this->getId();
        }

        return false;
    }

    public function isNot(BaseIdentifiableInterface $identifiable): bool
    {
        return false === $this->is($identifiable);
    }
}
