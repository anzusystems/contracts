<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Document\Interfaces;

interface DocumentInterface
{
    /**
     * Get ID of document.
     */
    public function getId(): string;

    /**
     * Check if ID and resourceName are the same.
     */
    public function is(self $document): bool;

    /**
     * Get resource name of the document.
     */
    public static function getResourceName(): string;

    /**
     * Get system name of project.
     */
    public static function getSystem(): string;
}
