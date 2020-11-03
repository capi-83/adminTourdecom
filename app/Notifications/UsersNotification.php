<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use SnoerenDevelopment\DiscordWebhook\DiscordWebhookChannel;

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
    private $discord;

    /**
     * Create a new notification instance.
     *
     * @param $method
     * @param $profil
     * @param bool $discord
     */
    public function __construct($method, $profil, $discord = false)
    {
        $this->fromUser = Auth::user();
        $this->method = $method;
        $this->profil = $profil;
        $this->discord = $discord;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ($this->discord)?[DiscordWebhookChannel::class]:['database'];
    }

    /**
     * Get the Discord representation of the notification.
     *
     * @param  mixed $notifiable The notifiable model.
     * @return array
     */
    public function toDiscord($notifiable): array
    {
        // See https://discordapp.com/developers/docs/resources/webhook#execute-webhook for all options.
        return [
            'content' => $this->fromUser['name'] . ' => ' . $this->method . ' - '. $this->profil['name'].' - '. $this->profil['email']
        ];
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
