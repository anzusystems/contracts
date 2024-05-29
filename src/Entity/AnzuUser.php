<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity;

use AnzuSystems\Contracts\Entity\Embeds\Avatar;
use AnzuSystems\Contracts\Entity\Embeds\Person;
use AnzuSystems\Contracts\Entity\Interfaces\BaseIdentifiableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\EnableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\IdentifiableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\TimeTrackingInterface;
use AnzuSystems\Contracts\Entity\Interfaces\UserTrackingInterface;
use AnzuSystems\Contracts\Entity\Traits\EnableTrait;
use AnzuSystems\Contracts\Entity\Traits\NamedResourceTrait;
use AnzuSystems\Contracts\Entity\Traits\TimeTrackingTrait;
use AnzuSystems\Contracts\Entity\Traits\UserTrackingTrait;
use AnzuSystems\Contracts\Security\UserPermissionResolver;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @psalm-consistent-constructor
 */
#[ORM\MappedSuperclass]
abstract class AnzuUser implements
    IdentifiableInterface,
    EnableInterface,
    UserInterface,
    UserTrackingInterface,
    TimeTrackingInterface
{
    use NamedResourceTrait;
    use EnableTrait;
    use UserTrackingTrait;
    use TimeTrackingTrait;

    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[Serialize]
    protected ?int $id = null;

    /**
     * Unique Email of user.
     */
    #[ORM\Column(type: Types::STRING, length: 256, unique: true)]
    #[Assert\Email]
    #[Serialize]
    protected string $email = '';

    #[ORM\Embedded(class: Person::class)]
    #[Assert\Valid]
    #[Serialize]
    protected Person $person;

    #[ORM\Embedded(class: Avatar::class)]
    #[Assert\Valid]
    #[Serialize]
    protected Avatar $avatar;

    /**
     * List of assigned roles.
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize]
    protected array $roles = [];

    /**
     * List of permissions which belongs to user.
     *
     * @var array<string, int>
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    protected array $permissions = [];

    /**
     * Assigned permission groups.
     *
     * Override in your project to get relations:
     * #[ORM\ManyToMany(targetEntity: PermissionGroup::class, inversedBy: 'users', fetch: 'EXTRA_LAZY', indexBy: 'id')]
     * #[ORM\JoinTable]
     * #[Serialize(handler: EntityIdHandler::class, type: PermissionGroup::class)]
     */
    protected Collection $permissionGroups;

    public function __construct()
    {
        $this->setPermissionGroups(new ArrayCollection());
        $this->setAvatar(new Avatar());
        $this->setPerson(new Person());
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->getId();
    }

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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function getAvatar(): Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(Avatar $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
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

    /**
     * @return array<string, int>
     */
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
     * @return Collection<int, AnzuPermissionGroup>
     */
    public function getPermissionGroups(): Collection
    {
        return $this->permissionGroups;
    }

    public function setPermissionGroups(Collection $permissionGroups): static
    {
        $this->permissionGroups = $permissionGroups;

        return $this;
    }

    /**
     * @return array<string, int>
     */
    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    public function getResolvedPermissions(): array
    {
        return UserPermissionResolver::resolve($this);
    }
}
