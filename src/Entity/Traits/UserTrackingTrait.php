<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\Contracts\Entity\AnzuUser;
use AnzuSystems\SerializerBundle\Attributes\Serialize;
use AnzuSystems\SerializerBundle\Handler\Handlers\EntityIdHandler;
use AnzuSystems\SerializerBundle\Metadata\ContainerParam;
use Doctrine\ORM\Mapping as ORM;

trait UserTrackingTrait
{
    #[ORM\ManyToOne(targetEntity: AnzuUser::class)]
    #[ORM\JoinColumn]
    protected AnzuUser $createdBy;

    #[ORM\ManyToOne(targetEntity: AnzuUser::class)]
    #[ORM\JoinColumn]
    protected AnzuUser $modifiedBy;

    #[Serialize(handler: EntityIdHandler::class, type: new ContainerParam(AnzuUser::class))]
    public function getCreatedBy(): AnzuUser
    {
        return $this->createdBy ?? new class extends AnzuUser {
            public function getUserIdentifier(): string
            {
                return '';
            }
        };
    }

    public function setCreatedBy(AnzuUser $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    #[Serialize(handler: EntityIdHandler::class, type: new ContainerParam(AnzuUser::class))]
    public function getModifiedBy(): AnzuUser
    {
        return $this->modifiedBy ?? new class extends AnzuUser {
            public function getUserIdentifier(): string
            {
                return '';
            }
        };
    }

    public function setModifiedBy(AnzuUser $modifiedBy): static
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }
}
