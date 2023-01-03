<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

use AnzuSystems\Contracts\Entity\AnzuUser;
use Doctrine\Common\Collections\Collection;

interface OwnersAwareInterface
{
    /**
     * @return Collection<int, AnzuUser>
     */
    public function getOwners(): Collection;
}
