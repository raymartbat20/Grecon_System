<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Transaction extends Notification
{
    use Queueable;

    protected $auth_user;

    protected $customer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_user,$customer)
    {
        $this->auth_user = $auth_user;
        $this->customer = $customer;
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
        return [
            "title" => "Transaction created",
            "message" => $this->auth_user->getFullName()." Created a new transaction",
            "link" => "/admin/transaction/".$this->customer->customer_id,
            "badge" => [
                'bg' => 'success',
                'icon' => 'fa fa-money mx-0',
            ],
        ];
    }
}
