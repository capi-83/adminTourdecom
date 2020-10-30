<?php

namespace App\Role;

use http\Exception\BadQueryStringException;

/***
 * Class UserRole
 * @package App\Role
 */
class UserRole {

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_COMMANDANT = 'ROLE_COMMANDANT';
    const ROLE_GARDIEN = 'ROLE_GARDIEN';
    const ROLE_DISCORD = 'ROLE_DISCORD';
    const ROLE_REDAC_CHEF = 'ROLE_REDAC_CHEF';
    const ROLE_REDAC = 'ROLE_REDAC';
    const ROLE_DECK_EVALUATOR = 'ROLE_DECK_EVALUATOR';
    const ROLE_MEMBRE = 'ROLE_MEMBRE';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_SUPERADMIN => ['*'],
        self::ROLE_COMMANDANT => [
            self::ROLE_GARDIEN,
            self::ROLE_REDAC,
            self::ROLE_DECK_EVALUATOR,
            self::ROLE_DISCORD,
            self::ROLE_REDAC_CHEF,
            self::ROLE_MEMBRE
        ],
        self::ROLE_GARDIEN => [
            self::ROLE_REDAC,
            self::ROLE_DISCORD,
            self::ROLE_REDAC_CHEF,
            self::ROLE_MEMBRE
        ],
        self::ROLE_DISCORD => [
            self::ROLE_MEMBRE
        ],
        self::ROLE_REDAC_CHEF => [
            self::ROLE_REDAC,
            self::ROLE_MEMBRE
        ],
        self::ROLE_DECK_EVALUATOR => [
            self::ROLE_MEMBRE
        ],
        self::ROLE_REDAC => [
            self::ROLE_MEMBRE
        ],
        self::ROLE_MEMBRE

    ];


    /**
     * @return array
     */
    public static function getrolesHasChild(){
        $listRole = [];
        foreach(self::$roleHierarchy as $rhkey => $rhvalue) {
            if(is_array($rhvalue)) {
                array_push($listRole,$rhkey);
            }
        }

        return $listRole;
    }

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_SUPERADMIN =>'Super Admin',
            static::ROLE_COMMANDANT => 'Commandant en chef',
            static::ROLE_GARDIEN => 'Gardien de la tour',
            static::ROLE_DISCORD => 'Discord admin',
            static::ROLE_REDAC_CHEF => 'Rédacteur web en chef',
            static::ROLE_REDAC => 'Rédacteur web',
            static::ROLE_DECK_EVALUATOR => 'Deck Evaluator',
            static::ROLE_MEMBRE => 'Membre',
        ];
    }

    /**
     * @param $role
     * @return string
     */
    public static function getHumanRole($role)
    {
      return self::getRoleList()[$role];
    }
}
