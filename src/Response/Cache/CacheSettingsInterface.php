<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Response\Cache;

use Symfony\Component\HttpFoundation\Response;

interface CacheSettingsInterface
{
    public function setCache(Response $response): Response;

    public static function buildXKeyFromObject(object $data): string;

    public static function getProjectXkey(): string;
}
