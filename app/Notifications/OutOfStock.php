<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Product;

class OutOfStock extends Notification
{
    use Queueable;

    public $product;

    protected $role;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product,$role)
    {
        $this->product = $product;
        $this->role    = $role;
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
            "title" => "Product ".$this->product->product_id,
            "message"    => "Product (".$this->product->product_name.") ran out of stock",
            "link"       => "/".$this->role."/products/".$this->product->product_id."/edit",
            "badge" => [
                "bg" => 'danger',
                "icon"  => 'fa fa-gavel mx-0',
            ],
        ];
    }
}
