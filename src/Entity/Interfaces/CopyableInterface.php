<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface CopyableInterface
{
    /**
     * Get deep copy of entity.
     */
    public function __copy(): self;
}
