<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\FirebaseMessaging;

class FirebaseService
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory)->withServiceAccount(config('firebase.service_account'))
            ->createMessaging();
    }

    public function sendNotification($title, $body, $deviceTokens, $data = [])
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $deviceTokens)
            ->withNotification($notification);

        if (!empty($data)) {
            $message = $message->withData($data);
        }

        FirebaseMessaging::send($message);
    }

    public function sendMessage($message, $deviceTokens, $data = [])
    {
        $message = CloudMessage::withTarget('token', $deviceTokens)
            ->withData($message);

        if (!empty($data)) {
            $message = $message->withData($data);
        }

        FirebaseMessaging::send($message);
    }
}
