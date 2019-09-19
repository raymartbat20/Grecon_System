<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CategoryResource extends Notification
{
    use Queueable;

    protected $auth_user;

    protected $category;

    protected $resource;

    protected $badge;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_user,$category,$resource,$badge = [])
    {
        $this->auth_user = $auth_user;
        $this->category = $category;
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
            "title" => "Category ".$this->resource,
            "message" => $this->auth_user->getFullName()." ".$this->resource." category ".$this->category->category,
            "link"  => "/admin/category",
            "badge" => [
                "bg" => $this->badge['bg'],
                "icon" => $this->badge['icon'],
            ],
        ];
    }
}
