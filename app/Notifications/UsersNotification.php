<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class UsersNotification extends Notification
{
    const USER_UPDATED = 'Updated',
          USER_DELETED = 'Deleted',
          USER_CREATED = 'Created',
          USER_DISABLED = 'Disabled',
          USER_ENABLED = 'Enabled';

    use Queueable;

    private $fromUser;
    private $method;
    private $profil;

    /**
     * Create a new notification instance.
     *
     * @param $method
     * @param $profil
     */
    public function __construct($method, $profil)
    {
        $this->fromUser = Auth::user();
        $this->method = $method;
        $this->profil = $profil;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        switch($this->method){
            case self::USER_UPDATED:
                $badge='cyan';
                break;
            case self::USER_CREATED:
                $badge='success';
                break;
            case self::USER_DISABLED:
                $badge='warning';
                break;
            case self::USER_DELETED:
                $badge='danger';
                break;
            case self::USER_ENABLED:
            default:
                $badge='info';
                break;
        }

        return [
            'fromUser' => $this->fromUser,
            'method' => $this->method,
            'profil' => $this->profil,
            'badge' => $badge
        ];
    }
}
