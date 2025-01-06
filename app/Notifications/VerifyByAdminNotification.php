<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
//use NotificationChannels\Fcm\FcmChannel;
//
//use Kreait\Firebase\Firestore;
//use NotificationChannels\Fcm\FcmMessage;
//use NotificationChannels\Fcm\Resources\AndroidConfig;
//use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
//use NotificationChannels\Fcm\Resources\AndroidMessagePriority;
//use NotificationChannels\Fcm\Resources\AndroidNotification;
//use NotificationChannels\Fcm\Resources\ApnsConfig;
//use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
//use NotificationChannels\Fcm\Resources\NotificationPriority;


class VerifyByAdminNotification extends Notification
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

        return ['database'];
    }

//    public function toFcm($notifiable)
//    {
//
//        return FcmMessage::create()
//            ->setData(['order_id' => ''.$this->data['order_id'],'type' => ''.$this->data['type'],
//                'branch_id' => ''.$this->data['branch_id'], 'order_accept_url' => ''.route('orders.accept'),
//                ])
//            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
//                ->setTitle(''.$this->data['title_'.$this->lang])
//                ->setBody(''.$this->data['body_'.$this->lang]))
//
//            ->setAndroid(
//                AndroidConfig::create()
//                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
//                    ->setNotification(
//                        AndroidNotification::create()
//                            ->setColor('#0A0A0A')
//                            ->setNotificationPriority(NotificationPriority::PRIORITY_MAX)
//                    )
//                    ->setPriority(AndroidMessagePriority::HIGH)
//            )->setApns(
//                ApnsConfig::create()
//                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
//            );
//    }

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
            'meta' =>[
                'user_id' => $this->data['user_id']
            ],
        ];
    }
}
