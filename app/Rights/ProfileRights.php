<?php


namespace App\Rights;


use App\Role\RoleChecker;
use App\Role\UserRole;
use App\Models\User;

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

    /**
     * @param string $access
     * @return bool
     */
    public function hasAccess(string $access) {
        return $this->hasBasicAccess(self::ACCESS_RIGHTS[$access], $access);
    }

    /**
     * @param User $user
     * @return array
     */
    public function getSpecificRights(User $user): array {
        return $this->getBasicSpecificRights($user,self::SPECIFIC_RIGHTS);
    }

    /**
     * @param $profil
     * @param $currentUser
     * @return bool
     */
    public function islockedProfile(User $profil,User $currentUser): bool {
        $myaccount = $this->isMyProfile($profil,$currentUser);

        return RoleChecker::isSuperAdminProfile($profil) && !$myaccount;
    }

    /**
     * @param $profil
     * @param $currentUser
     * @return bool
     */
    public function isMyProfile(User $profil, User $currentUser): bool{
        return $profil->id === $currentUser->id;
    }

}
