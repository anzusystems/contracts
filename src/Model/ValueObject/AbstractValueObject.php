<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\ValueObject;

use DomainException;

abstract class AbstractValueObject implements ValueObjectInterface
{
    public const DEFAULT_VALUE = '';
    public const AVAILABLE_VALUES = [];

    protected string $value;

    public function __construct(?string $value = null)
    {
        $value ??= static::DEFAULT_VALUE;
        if (false === in_array($value, static::AVAILABLE_VALUES, true)) {
            throw new DomainException(sprintf(
                'The value "%s" does not exist in "%s"',
                $value,
                static::class,
            ));
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function is(string $value): bool
    {
        return $value === $this->value;
    }

    public function isNot(string $value): bool
    {
        return false === $this->is($value);
    }

    public function in(array $values): bool
    {
        return in_array($this->value, $values, true);
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        return $valueObject->is($this->value);
    }

    public function toString(): string
    {
        return (string) $this;
    }
}
