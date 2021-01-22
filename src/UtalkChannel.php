<?php

namespace Powertic\Utalk;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Notifications\Notification;
use Powertic\Utalk\Exceptions\CouldNotSendNotification;
use Powertic\Utalk\Exceptions\InvalidConfiguration;

class UtalkChannel
{
    /** @var Utalk */
    protected $utalk;

    /**
     * @param Utalk $utalk
     */
    public function __construct(Utalk $utalk)
    {
        $this->utalk = $utalk;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return \GuzzleHttp\Psr7\Response
     *
     * @throws \Powertic\Utalk\Exceptions\InvalidConfiguration
     * @throws \Powertic\Utalk\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        // Exit if $notifiable doesn't have a route
        if (!$to = $notifiable->routeNotificationFor('utalk')) {
            return;
        }

        // Exit if token not found
        if (!$token = $this->utalk->getToken()) {
            throw new InvalidConfiguration();
        }

        $body = $notification->toUtalk($notifiable)->toArray();

        $client = new Client(
            [
                'timeout' => 90,
                'base_uri' => 'https://v1.utalk.chat/send/'
            ]
        );

        $response = $client->request(
            'GET',
            $token,
            [
                RequestOptions::HEADERS => [
                    'User-Agent' => 'Laravel/' . app()->version()
                ],
                RequestOptions::QUERY => [
                    'token' => $token,
                    'cmd' => 'chat',
                    'id' => uniqid(),
                    'to' => $to,
                    'msg' => $body["message"]
                ]
            ]
        );

        return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);

        if ($response->getStatusCode() >= 300 || $response->getStatusCode() < 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $response;
    }
}
