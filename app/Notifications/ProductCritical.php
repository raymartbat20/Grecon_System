<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductCritical extends Notification
{
    use Queueable;

    protected $role;

    public $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product,$role)
    {
        $this->product = $product;
        $this->role = $role;
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
            "message"    => "Product (".$this->product->product_name.") is on Critical level",
            "link"       => "/".$this->role."/".""."products/".$this->product->product_id."/edit",
            "badge" =>  [
                "bg" => 'danger',
                "icon"  => 'fa fa-gavel mx-0',
            ],
        ];
    }
}
