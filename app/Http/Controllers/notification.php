<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotificationChannels\Fcm\FcmMessage;

class notification extends Controller
{
    //

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            // ->setData(['data1' => 'value', 'data2' => 'value2'])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('test title')
                ->setBody($this->pesan()));
    }
}
