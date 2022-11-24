<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface IdentifiableInterface extends BaseIdentifiableInterface
{
    /**
     * Get ID of entity.
     */
    public function getId(): ?int;

    /**
     * Set ID of entity.
     */
    public function setId(?int $id): static;
}
