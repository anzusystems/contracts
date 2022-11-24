<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\Enum;

trait BaseEnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function is(EnumInterface $enum): bool
    {
        return $enum === $this;
    }

    public function isNot(EnumInterface $enum): bool
    {
        return false === $this->is($enum);
    }

    public function in(array $enums): bool
    {
        return in_array($this, $enums, true);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
