<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use App\User;
use App\Role\RoleChecker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Debugbar;

/**
 * Class CheckUserRole
 * @package App\Http\Middleware
 */
class CheckUserRole
{
    /**
     * @var RoleChecker
     */
    protected $roleChecker;

    public function __construct(RoleChecker $roleChecker)
    {
        $this->roleChecker = $roleChecker;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string $role
     * @param bool $adminAccess
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next,string $role)
    {
        /** @var User $user */
        $user = Auth::guard()->user();
        $roles = explode('|', $role);

        if(!$user) {
            return redirect(RouteServiceProvider::HOME);
        }

        if(!$roles)
        {
            if (!$this->roleChecker->haveAdminAccess($user)) {
                return redirect(RouteServiceProvider::HOME);
            }

        }
        else {
            if (!$this->roleChecker->check($user, $roles)) {
                dd($user,$roles,$request);
                //return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
