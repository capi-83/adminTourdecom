<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Role\RoleChecker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return view('notifications.list',
            ['userNotifications'=> $user->notifications->where('type','App\Notifications\UsersNotification')]);
    }


    public function readAllNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
