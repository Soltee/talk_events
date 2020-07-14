<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class UserDeleted extends Notification implements ShouldQueue
{
    use Queueable;
    public $email;
    public $first_name;
    public $last_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $email, string $first_name, string $last_name)
    {
        $this->email        = $email;
        $this->first_name   = $first_name;
        $this->last_name    = $last_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $email = $this->email;
        $first = $this->first_name;
        $last  = $this->last_name;

        return (new MailMessage)
                    ->from('admin@example.com', 'Events')
                    ->subject($first $last . ' Deleted')
                    ->markdown('mail.userdeleted', [
                        'email' => $email,
                        'first' => $first,
                        'last'  => $last
                    ]);
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
            //
        ];
    }
}
