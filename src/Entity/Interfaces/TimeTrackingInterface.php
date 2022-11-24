<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

use DateTimeImmutable;

interface TimeTrackingInterface
{
    public function getCreatedAt(): DateTimeImmutable;

    public function setCreatedAt(DateTimeImmutable $createdAt): static;

    public function getModifiedAt(): DateTimeImmutable;

    public function setModifiedAt(DateTimeImmutable $modifiedAt): static;
}
