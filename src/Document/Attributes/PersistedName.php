<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Document\Attributes;

use Attribute;

#[Attribute]
final class PersistedName
{
    public function __construct(
        public string $name,
    ) {
    }
}
