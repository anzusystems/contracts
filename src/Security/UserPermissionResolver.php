<?php

declare(strict_types=1);

namespace AnzuSystems\Contracts\Security;

use AnzuSystems\Contracts\Entity\AnzuPermissionGroup;
use AnzuSystems\Contracts\Entity\AnzuUser;

/**
 * Resolves user permissions from user's permissions groups and his own permissions.
 */
final class UserPermissionResolver
{
    public static function resolve(AnzuUser $user): array
    {
        return array_merge(
            self::resolveForGroups($user->getPermissionGroups()),
            $user->getPermissions()
        );
    }

    /**
     * @param iterable<int, AnzuPermissionGroup> $permissionGroups
     */
    public static function resolveForGroups(iterable $permissionGroups): array
    {
        $permissions = [];
        foreach ($permissionGroups as $permissionGroup) {
            foreach ($permissionGroup->getPermissions() as $permissionName => $permissionValue) {
                if (false === array_key_exists($permissionName, $permissions)) {
                    $permissions[$permissionName] = $permissionValue;
                    continue;
                }
                if ($permissions[$permissionName] < $permissionValue) {
                    $permissions[$permissionName] = $permissionValue;
                }
            }
        }

        return $permissions;
    }
}
