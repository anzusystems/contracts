<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

use AnzuSystems\Contracts\Entity\AnzuUser;

interface UserTrackingInterface
{
    public function getCreatedBy(): AnzuUser;

    public function setCreatedBy(AnzuUser $createdBy): static;

    public function getModifiedBy(): AnzuUser;

    public function setModifiedBy(AnzuUser $modifiedBy): static;
}
