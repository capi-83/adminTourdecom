<?php

namespace App\Models;

use App\Role\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed id
 * @property mixed disabled
 * @property mixed name
 * @property mixed password
 * @property mixed email
 * @property mixed discordTag
 * @property mixed twitter
 * @property mixed mtgaTag
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $discord_webhook = "https://discordapp.com/api/webhooks/773134336793772032/FLfnhDFvSMQJuOh9rhK2zlf2-sE8q65eq3NL45VcFxU6pWCP7cQ1oIWzUKpjs13Glb1R";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array',
    ];

    public function routeNotificationForDiscord(): string
    {
        return $this->discord_webhook;
    }

    public function scopeNotified($query)
    {
        return $query->where('roles','like','%'. UserRole::ROLE_GARDIEN . '%')->orWhere('roles','like','%'. UserRole::ROLE_SUPERADMIN. '%');
    }


    /***
     * @param string $role
     * @return $this
     */
    public function addRole(string $role)
    {
        $roles = $this->getRoles();
        $roles[] = $role;

        $roles = array_unique($roles);
        $this->setRoles($roles);

        return $this;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles)
    {
        $this->setAttribute('roles', $roles);
        return $this;
    }

    /***
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    /***
     * @param $roles
     * @return mixed
     */
    public function hasRoles($roles)
    {
        $currentRoles = $this->getRoles();
        foreach($roles as $role) {
            if ( ! in_array($role, $currentRoles )) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->getAttribute('roles');

        if (is_null($roles)) {
            $roles = [];
        }

        return $roles;
    }

    /**
     * @return $this
     */
    public function toggleDisabled()
    {
        $this->setAttribute('disabled',!$this->disabled);
        return $this;
    }
}
