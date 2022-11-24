<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\ValueObject;

use Stringable;

interface ValueObjectInterface extends Stringable
{
    public function __toString(): string;

    public function is(string $value): bool;

    public function isNot(string $value): bool;

    public function in(array $values): bool;

    public function equals(self $valueObject): bool;

    public function toString(): string;
}
