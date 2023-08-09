<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface PositionAwareInterface
{
    public function getPosition(): int;

    public function setPosition(int $position): static;
}
