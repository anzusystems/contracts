<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity;

use AnzuSystems\SerializerBundle\Attributes\Serialize;
use AnzuSystems\Contracts\Entity\Interfaces\BaseIdentifiableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\EnableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\IdentifiableInterface;
use AnzuSystems\Contracts\Entity\Traits\EnableTrait;
use AnzuSystems\Contracts\Entity\Traits\NamedResourceTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AnzuUser implements IdentifiableInterface, EnableInterface, UserInterface
{
    use NamedResourceTrait;
    use EnableTrait;

    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[Serialize]
    protected ?int $id = null;

    /**
     * List of assigned roles.
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize]
    protected array $roles = [];

    public function is(BaseIdentifiableInterface $identifiable): bool
    {
        if ($identifiable::getResourceName() === static::getResourceName()) {
            return $identifiable->getId() === $this->getId();
        }

        return false;
    }

    public function isNot(BaseIdentifiableInterface $identifiable): bool
    {
        return false === $this->is($identifiable);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPassword(): ?string
    {
        return null;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
}
