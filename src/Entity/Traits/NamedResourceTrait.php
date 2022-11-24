<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Traits;

use AnzuSystems\Contracts\AnzuApp;
use AnzuSystems\SerializerBundle\Attributes\Serialize;

trait NamedResourceTrait
{
    /**
     * Name of this resource.
     */
    #[Serialize(serializedName: '_resourceName')]
    public static function getResourceName(): string
    {
        return lcfirst(substr((string) strrchr(static::class, '\\'), 1));
    }

    /**
     * Name of this system.
     */
    #[Serialize(serializedName: '_system')]
    public static function getSystem(): string
    {
        return AnzuApp::getAppSystem();
    }
}
