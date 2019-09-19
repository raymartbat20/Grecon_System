<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateUser extends Notification
{
    use Queueable;

    protected $user;
    
    protected $new_user;

    protected $resource;

    protected $badge;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$new_user,$resource,$badge = [])
    {
        $this->user = $user;
        $this->new_user = $new_user;
        $this->resource = $resource;
        $this->badge = $badge;
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
    public function toDatabase($notifiable)
    {
        return [
            "title"     => "User ".$this->resource,
            "message"   => $this->user->getFullName().' '.$this->resource.' user '.$this->new_user->getFullName(),
            "link"      => "/admin/users",
            "badge" => [
                'bg' => $this->badge['bg'],
                'icon'  => $this->badge['icon'],
            ],
        ];
    }
}
