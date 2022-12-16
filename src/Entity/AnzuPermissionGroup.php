<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity;

use AnzuSystems\Contracts\Entity\Interfaces\IdentifiableInterface;
use AnzuSystems\Contracts\Entity\Interfaces\TimeTrackingInterface;
use AnzuSystems\Contracts\Entity\Interfaces\UserTrackingInterface;
use AnzuSystems\Contracts\Entity\Traits\IdentityTrait;
use AnzuSystems\Contracts\Entity\Traits\TimeTrackingTrait;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

abstract class AnzuPermissionGroup implements IdentifiableInterface, UserTrackingInterface, TimeTrackingInterface
{
    use IdentityTrait;
    use TimeTrackingTrait;

    /**
     * User defined title.
     */
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    #[Serialize]
    protected string $title;

    /**
     * User defined description.
     */
    #[ORM\Column(type: Types::STRING, length: 2_000)]
    #[Serialize]
    protected string $description;

    /**
     * List of permissions which belongs to permission group.
     */
    #[ORM\Column(type: Types::JSON)]
    #[Serialize(strategy: Serialize::KEYS_VALUES)]
    protected array $permissions;

    public function __construct()
    {
        $this->setTitle('');
        $this->setDescription('');
        $this->setPermissions([]);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
}
