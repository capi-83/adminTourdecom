<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Role\RoleChecker;
use App\Role\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $nbrUsers = $users->count();
        $nbrDisabledUsers = $users->where('disabled','=',1)->count();
        $nbrAdmins = 0;
        foreach($users as $u) {
            if(RoleChecker::haveAdminAccess($u)) {
                $nbrAdmins ++;
            }
        }

        return view('dashboard', [
            'totalUsers' => $nbrUsers,
            'admins' => $nbrAdmins,
            'disabledUsers'=> $nbrDisabledUsers,
            'enabledUsers'=>$nbrUsers - $nbrAdmins - $nbrDisabledUsers]);
    }
}
