<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ObatNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $text;

    
    public function __construct($user,$text)
    {
        $this->user = $user;
        $this->text = $text;
    }
  
    public function via($notifiable)
    {
        return ['database'];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    
    public function toArray($notifiable)
    {
        return [
            'name' => $this->user,
            'text' => $this->text
        ];
    }
}
