<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Events\VehicleDriverEvent;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VehicleDriverCreated extends Notification
{
    use Queueable;

    protected $data;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($driver)
    {
        $this->data = $driver;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toDatabase($notifiable)
    {   
        event(new VehicleDriverEvent($this->id, $this->data, $notifiable));

        $data = [
            'id' => $this->id,
            'event' => 'VehicleDriverCreated',
            'to' => 'admin',
            'name' => 'Nokarin',
            'avatar' => '',
            'link' => '',
            'type' => 'vehicle_driver_upgrade_request',
            'message' => $this->data->first_name . ' ' . 'created a new vehicle driver!',
        ];

        return [
            'id' => $this->id,
            'for_admin' =>  1,
            'notification' => $data
        ];
    }
}
