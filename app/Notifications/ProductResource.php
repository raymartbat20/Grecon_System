<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductResource extends Notification
{
    use Queueable;
    
    protected $auth_user;

    protected $product;

    protected $resource;

    protected $badge;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_user,$product,$resource,$badge = [])
    {
        $this->auth_user = $auth_user;
        $this->product = $product;
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
            "title"     => $this->resource." Product",
            "message"   => $this->auth_user->getFullName()." ". $this->resource." the product "
            .$this->product->product_name,
            "link"      => "/admin/products/".$this->product->product_id."/edit",
        ];
    }
}
