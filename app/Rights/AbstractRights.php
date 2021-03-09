<?php

namespace App\Rights;


abstract class AbstractRights
{
    const ACCESS_RIGHTS = [];

    /**
     * retourne les droit d'acces dans un format pour les routes
     * @return string
     */
    static final function getRouteAccess() : string{
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
    static final function getInterfaceAccess(string $type = "show"): array {
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
}
