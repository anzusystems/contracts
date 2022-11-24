<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Entity\Interfaces;

interface BaseIdentifiableInterface
{
    /**
     * Get ID of entity.
     */
    public function getId(): mixed;

    /**
     * Check if ID and resourceName are the same.
     */
    public function is(self $identifiable): bool;

    /**
     * Check if ID and resourceName are NOT the same.
     */
    public function isNot(self $identifiable): bool;

    /**
     * Get resource name of the entity.
     */
    public static function getResourceName(): string;

    /**
     * Get system name of project.
     */
    public static function getSystem(): string;
}
