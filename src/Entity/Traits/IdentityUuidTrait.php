<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\Contracts\Entity\Interfaces\BaseIdentifiableInterface;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

trait IdentityUuidTrait
{
    use NamedResourceTrait;

    /**
     * Primary key of this item.
     */
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[Assert\Uuid]
    #[Serialize]
    protected Uuid $id;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function is(BaseIdentifiableInterface $identifiable): bool
    {
        if ($identifiable::getResourceName() === $this->getResourceName()) {
            return $this->getId()->equals($identifiable->getId());
        }

        return false;
    }

    public function isNot(BaseIdentifiableInterface $identifiable): bool
    {
        return false === $this->is($identifiable);
    }
}
