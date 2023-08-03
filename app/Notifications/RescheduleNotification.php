<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RescheduleNotification extends Notification
{
    use Queueable;
    private $messages;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
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
            ->subject('Reschedule Notification')
            ->line('Berikut Untuk Perubahan Jadwal Pemeriksaan')
            ->line('Tanggal Periksa : '.$this->messages['tanggal'])
            ->line('Nomer Antrian : '.$this->messages['antrian'])
            ->line('Spesialis : '.$this->messages['spesialis'])
            ->line('Nama Dokter : '.$this->messages['dokter'])
            // ->action('View Reschedule', route('reschedule.show', $this->reschedule->id))
            ->line('Terimak Kasih!');
    }

    // public function setReschedule($reschedule)
    // {
    //     $this->reschedule = $reschedule;
    //     return $this;
    // }

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
