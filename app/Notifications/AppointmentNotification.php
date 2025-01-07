<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;


class AppointmentNotification extends Notification
{
    use Queueable;
    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return [FcmChannel::class,'database'];
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'title' => $this->data['title'],
                'body' => $this->data['body'],
                'type' => $this->data['type'],
                'created_at' => now()."",
                'meta' => json_encode([  // تحويل المصفوفة إلى سلسلة نصية
                    'user_id' => $this->data['user_id']
                ])
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->data['title'])
                ->setBody($this->data['body']));
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
            'title' => $this->data['title'],
            'body' => $this->data['body'],
            'type' => $this->data['type'],
            'meta' => json_encode([  // تحويل المصفوفة إلى سلسلة نصية
                'user_id' => $this->data['user_id']
            ]),
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

}
