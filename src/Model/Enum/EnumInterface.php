<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\Enum;

/**
 * @method static static|null tryFrom(string $value)
 * @method static static from(string $value)
 * @property string $value
 */
interface EnumInterface
{
    public const Default = '';

    public static function values(): array;

    public function is(self $enum): bool;

    public function isNot(self $enum): bool;

    /**
     * @param list<EnumInterface> $enums
     */
    public function in(array $enums): bool;

    public function toString(): string;
}
