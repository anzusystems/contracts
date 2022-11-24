<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface EnableInterface
{
    /**
     * Get enabled state of entity.
     */
    public function isEnabled(): bool;

    /**
     * Set enabled state of entity.
     */
    public function setEnabled(bool $enabled): static;
}
