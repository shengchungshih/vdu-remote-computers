<?php


namespace App\Http\Services;


class PermissionService
{
    public const permissionParent = 'rdp_is';

    public static function checkIfUserHasPermission($permission): bool
    {
        $username = auth()->user()->username;
        $userPermissions = json_decode(self::getUserRights($username), true);

        if(!isset($userPermissions['data'][self::permissionParent])) {
            return false;
        }

        if (!in_array($permission, $userPermissions['data'][self::permissionParent], false)) {
            return false;
        }

        return true;
    }

    private static function getUserRights($username)
    {
        return file_get_contents("https://sso.vdu.lt/api/user/$username/permissions");
    }
}
