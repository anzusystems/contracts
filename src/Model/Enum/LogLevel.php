<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Model\Enum;

enum LogLevel: string implements EnumInterface
{
    use BaseEnumTrait;

    case Debug = 'DEBUG';
    case Info = 'INFO';
    case Notice = 'NOTICE';
    case Warning = 'WARNING';
    case Error = 'ERROR';
    case Critical = 'CRITICAL';
    case Alert = 'ALERT';
    case Emergency = 'EMERGENCY';

    public const Default = self::Error;

    public function logMethodName(): string
    {
        return strtolower($this->toString());
    }
}
