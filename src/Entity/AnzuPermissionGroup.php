<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity;

use AnzuSystems\Contracts\Entity\Interfaces\IdentifiableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\TimeTrackingInterface;
use AnzuSystems\Contracts\Entity\Interfaces\UserTrackingInterface;
use AnzuSystems\Contracts\Entity\Traits\IdentityTrait;
use AnzuSystems\Contracts\Entity\Traits\TimeTrackingTrait;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\MappedSuperclass]
abstract class AnzuPermissionGroup implements IdentifiableInterface, UserTrackingInterface, TimeTrackingInterface
{
    use IdentityTrait;
    use TimeTrackingTrait;

    /**
     * User defined title.
     */
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    #[Serialize]
    #[Assert\Length(min: 3, max: 255)]
    protected string $title;

    /**
     * User defined description.
     */
    #[ORM\Column(type: Types::STRING, length: 2_000)]
    #[Serialize]
    #[Assert\Length(max: 2_000)]
    protected string $description;

    /**
     * List of permissions which belongs to permission group.
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    protected array $permissions;

    /**
     * List of users who belongs to permission group.
     *
     * Override in your project to get relations:
     * #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'permissionGroups', indexBy: 'id')]
     * #[Serialize(handler: EntityIdHandler::class, type: User::class)]
     */
    protected Collection $users;

    public function __construct()
    {
        $this->setTitle('');
        $this->setDescription('');
        $this->setPermissions([]);
        $this->setUsers(new ArrayCollection());
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): static
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * @return Collection<int, AnzuUser>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function setUsers(Collection $users): static
    {
        $this->users = $users;

        return $this;
    }
}
