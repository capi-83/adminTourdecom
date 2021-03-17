<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Role\RoleChecker;
use Illuminate\Contracts\Support\Renderable;

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
     * @return Renderable
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

        return view('admin.dashboard', [
            'totalUsers' => $nbrUsers,
            'admins' => $nbrAdmins,
            'disabledUsers'=> $nbrDisabledUsers,
            'enabledUsers'=>$nbrUsers - $nbrAdmins - $nbrDisabledUsers]);
    }
}
