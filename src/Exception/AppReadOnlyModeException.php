<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Exception;

final class AppReadOnlyModeException extends AnzuException
{
    public const MESSAGE = 'app_read_only_mode';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
