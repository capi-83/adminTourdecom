<?php

namespace App\Rights;


use App\Role\RoleChecker;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

abstract class AbstractRights
{
    const ACCESS_RIGHTS = [];

    /**
     * retourne les droit d'acces dans un format pour les routes
     * @return string
     */
    public static final function getRouteAccess() : string{
        $role = '';
        $c = get_called_class();
        $rights=  $c::ACCESS_RIGHTS;
        if(isset($rights['show'])) {
            foreach($rights['show'] as $accessRole => $accessRight) {
                $separator = (array_key_last($rights['show']) === $accessRole)?'':'|';
                $role .= $accessRole.$separator;
            }
        }

        return $role;
    }

    /**
     * retourne les droits d'acces pour la vue.(menu)
     * on peut specifier le type d'acces.
     * @param string $type
     * @return array
     */
    public static final function getInterfaceAccess(string $type = "show"): array {
        $roles = [];
        $c = get_called_class();
        $rights=  $c::ACCESS_RIGHTS;
        if(isset($rights[$type])) {
            foreach($rights[$type] as $accessRole => $accessRight) {
                array_push($roles,$accessRole);
            }
        }
        return $roles;
    }

    /**
     * check access basiquement
     * @param array $rights
     * @param string $access
     * @return bool
     */
    protected final function hasBasicAccess(array $rights,string $access): bool {
        return RoleChecker::checkRolesRight($rights,Auth::user(),$access);
    }

    /**
     *
     * Check if user can use this rights
     *
     * @param User $user
     * @param array $spec
     * @return array
     */
    public static function getBasicSpecificRights(User $user,array $spec): array
    {
        $specificRights = [];
        foreach($spec as $srk => $srv)
        {
            $specificRights[$srk] = false;
            foreach($srv as $role)
            {
                if(RoleChecker::check($user,$role))
                {
                    $specificRights[$srk] = true;
                    break;
                }
            }
        }

        return $specificRights;
    }

}
