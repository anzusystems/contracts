<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Response\Cache;

use AnzuSystems\Contracts\AnzuApp;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractCacheSettings implements CacheSettingsInterface
{
    public function __construct(
        protected int $cacheTtl,
    ) {
    }

    public function setCache(Response $response): Response
    {
        $response->setPublic();
        $response->setMaxAge(0);
        $response->headers->set('X-Cache-Control-TTL', (string) $this->cacheTtl);
        $response->headers->set('X-Remove-Cookie', '1');
        $response->headers->remove('Expires');
        $this->setXKeys($response);

        return $response;
    }

    public static function buildXKeyFromObject(object $data): string
    {
        return '';
    }

    public static function getProjectXkey(): string
    {
        return 'anzu-' . AnzuApp::getAppNamespace() . '-' . AnzuApp::getAppSystem();
    }

    /**
     * @return list<string>
     */
    protected function getXKeys(): array
    {
        return [];
    }

    private function setXKeys(Response $response): void
    {
        $xKeys = [
            self::getProjectXkey(),
            ...array_map(fn (string $key) => self::getProjectXkey() . '-' . $key, $this->getXKeys()),
        ];
        $response->headers->set('xkey', implode(' ', $xKeys));
    }
}
