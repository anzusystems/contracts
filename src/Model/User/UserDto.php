<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\User;

use AnzuSystems\Contracts\Entity\AnzuPermissionGroup;
use AnzuSystems\Contracts\Entity\AnzuUser;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use AnzuSystems\SerializerBundle\Handler\Handlers\EntityIdHandler;
use AnzuSystems\SerializerBundle\Metadata\ContainerParam;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class UserDto
{
    #[Serialize]
    private ?int $id = null;

    #[Email, NotBlank, Length(max: 256)]
    #[Serialize]
    private string $email = '';

    #[Serialize]
    private bool $enabled = true;

    #[Serialize]
    private array $roles = [AnzuUser::ROLE_USER];

    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    private array $permissions = [];

    #[Serialize(handler: EntityIdHandler::class, type: new ContainerParam(AnzuPermissionGroup::class))]
    private Collection $permissionGroups;

    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    private array $data = [];

    public function __construct()
    {
        $this->setPermissionGroups(new ArrayCollection());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function getPermissionGroups(): Collection
    {
        return $this->permissionGroups;
    }

    public function setPermissionGroups(Collection $permissionGroups): self
    {
        $this->permissionGroups = $permissionGroups;

        return $this;
    }
}
