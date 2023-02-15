<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface CustomDataInterface
{
    public function getCustomData(): array;

    public function setCustomData(array $customData): static;
}
