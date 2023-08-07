<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

use Symfony\Component\Uid\Uuid;

interface IdentifiableByUuidInterface extends BaseIdentifiableInterface
{
    /**
     * Get ID of entity.
     */
    public function getId(): Uuid;

    /**
     * Set ID of entity.
     */
    public function setId(Uuid $id): static;
}
