<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Role\RoleChecker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function handle(Request $request, Closure $next, string $role, $adminAccess = false)
    {
        /** @var User $user */
        $user = Auth::guard()->user();

        if(!$adminAccess)
        {
            if (!$this->roleChecker->check($user, $role)) {
                Auth::logout();
                throw new AuthorizationException('You do not have permission to view this page');
            }
        }
        else {
            if (!$this->roleChecker->haveAdminAccess($user, $role)) {
                Auth::logout();
                throw new AuthorizationException('You do not have permission to view this page');
            }
        }

        return $next($request);
    }
}
