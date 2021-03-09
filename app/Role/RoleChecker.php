<?php



namespace App\Role;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class RoleChecker
 * @package App\Role
 */
class RoleChecker
{
    /**
     * @param User $user
     * @param array|string $roles
     * @return bool
     */
    public static function check(User $user, $roles)
    {

        // Admin has everything
        if ($user->hasRole(UserRole::ROLE_SUPERADMIN)) {
            return true;
        }

        if(!is_array($roles)) $roles = [$roles];
        if(!$roles) return self::haveAdminAccess($user);

        // Access for all child
        foreach(UserRole::getrolesHasChild() as $bigRole) {
            if($user->hasRole($bigRole)) {
                $managementRoles = UserRole::getAllowedRoles($bigRole);
                foreach($roles as $role) {
                    if (in_array($role, $managementRoles)) {
                        return true;
                    }
                }
            }
        }
        return $user->hasRoles($roles);
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function haveAdminAccess(User $user) {
        if(count($user->getRoles()) > 1 ) {
            return true;
        }
        //ROLE_MEMBRE DOSNT HAVE ACCESS
        return ! $user->hasRole(UserRole::ROLE_MEMBRE);
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function isSuperAdminProfile(User $user) {
        return self::check($user,UserRole::ROLE_SUPERADMIN);
    }

    /**
     *
     * Check if user can use this rights
     *
     * @param array $spec
     * @return array
     */
    public static function getSpecificRightsForAuth(array $spec)
    {
        $currentUser = Auth::user();
        $specificRights = [];
        foreach($spec as $srk => $srv)
        {
            $specificRights[$srk] = false;
            foreach($srv as $role)
            {
                if(RoleChecker::check($currentUser,$role))
                {
                    $specificRights[$srk] = true;
                    break;
                }
            }
        }

        return $specificRights;
    }
}
