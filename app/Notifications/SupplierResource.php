<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SupplierResource extends Notification
{
    use Queueable;

    protected $auth_user;

    protected $supplier;

    protected $badge;

    protected $resource;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_user,$supplier,$resource,$badge = [])
    {
        $this->auth_user = $auth_user;
        $this->supplier = $supplier;
        $this->badge = $badge;
        $this->resource = $resource;
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
            "title"     => "Supplier ".$this->resource,
            "message"   => $this->auth_user->getFullName()." ".$this->resource." supplier ".$this->supplier->getFullName(),
            "link"      => "/admin/suppliers",
            "badge"     => [
                "bg" => $this->badge['bg'],
                "icon" => $this->badge['icon'],
            ],
        ];
    }
}
