<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class UserAdded extends Notification implements ShouldQueue
{
    use Queueable;

    public $email;
    public $pass;
    public $role;
    public $permissions;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $email, string $pass, string $role, $permissions = array())
    {
        $this->email      = $email;
        $this->pass       = $pass;
        $this->role       = $role;
        $this->permissions  = $permissions;
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
        return (new MailMessage)
                            ->from('admin@example.com', 'Events')
                            ->subject('Login Credentials..')
                            ->markdown('mail.useradded', [
                                'email' => $this->email,
                                'pass'  => $this->pass,
                                'role'  => $this->role,
                                'permissions'  => $this->permissions
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
