<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    const TYPE = [
        'users' => 'App\Notifications\UsersNotification'
    ];

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
            ['userNotifications'=> $user->notification->where('type','App\Notifications\UsersNotification')]);
    }

    /**
     * @param $type
     * @return RedirectResponse
     */
    public function clear($type)
    {
        Auth::user()->notifications()->where('type',self::TYPE[$type])->delete();
        return back();
    }

    /**
     * @return RedirectResponse
     */
    public function readAllNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
