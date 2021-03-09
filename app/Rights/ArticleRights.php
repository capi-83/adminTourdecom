<?php


namespace App\Rights;


use App\Role\UserRole;

class ArticleRights extends AbstractRights
{
    /**
     * ACCESS Rights management
     */
    const ACCESS_RIGHTS = [
        'show' => [
            UserRole::ROLE_REDAC => 'show',
            UserRole::ROLE_CORRECTOR=> 'show'
        ],
    ];

}
