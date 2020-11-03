<?php


namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    const NOTIF_TYPE = ['App\Notifications\UsersNotification' => 'profile.index' ] ;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        if($user) {
            $countNotifications = $user->unreadNotifications()->count();

            $notifications = [];
            foreach(self::NOTIF_TYPE as $typeKey => $typeVal) {
                $notifications[$typeKey] =  [
                    'count' => $user->notifications->where('type',$typeKey)->count(),
                    'route' => route($typeVal),
                    'icon' => 'users'
                ];
            }

            $view->with(compact('countNotifications', 'notifications'));
        }

    }
}
