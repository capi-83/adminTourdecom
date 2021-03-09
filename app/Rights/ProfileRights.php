<?php


namespace App\Rights;


use App\Role\UserRole;

class ProfileRights extends AbstractRights
{
    /**
     * ACCESS Rights management
     */
    const ACCESS_RIGHTS = [
        'edit' => [
            UserRole::ROLE_SUPERADMIN => 'edit',
            UserRole::ROLE_COMMANDANT => 'edit',
            UserRole::ROLE_GARDIEN => 'show'
        ],
        'show' => [
            UserRole::ROLE_SUPERADMIN => 'edit',
            UserRole::ROLE_COMMANDANT => 'edit',
            UserRole::ROLE_GARDIEN => 'show'
        ],
        'create' => [
            UserRole::ROLE_SUPERADMIN => 'create',
            UserRole::ROLE_COMMANDANT => 'create'
        ],
        'update' => [
            UserRole::ROLE_SUPERADMIN => 'update',
            UserRole::ROLE_COMMANDANT => 'update'
        ],
        'disabled' => [
            UserRole::ROLE_SUPERADMIN => 'disabled',
            UserRole::ROLE_COMMANDANT => 'disabled',
            UserRole::ROLE_GARDIEN => 'disabled'
        ],
        'delete' => [
            UserRole::ROLE_SUPERADMIN => 'delete',
            UserRole::ROLE_COMMANDANT => 'delete'
        ],
    ];

    /**
     * Droits Specifique
     */
    const SPECIFIC_RIGHTS = [
        'roles' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT
        ],
        'delete' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT
        ],
        'disabled' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT,
            UserRole::ROLE_GARDIEN
        ]
    ];

}
