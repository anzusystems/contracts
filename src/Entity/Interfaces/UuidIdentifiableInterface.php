<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface UuidIdentifiableInterface extends BaseIdentifiableInterface
{
    /**
     * Get ID of entity.
     */
    public function getId(): ?string;

    /**
     * Set ID of entity.
     */
    public function setId(?string $id): static;
}
