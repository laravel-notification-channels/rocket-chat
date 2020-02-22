<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Notifications\Notification;
use NotificationChannels\RocketChat\Exceptions\CouldNotSendNotification;

final class RocketChatWebhookChannel
{
    /** @var \NotificationChannels\RocketChat\RocketChat The HTTP client instance. */
    private $rocketChat;

    /**
     * Create a new RocketChat channel instance.
     *
     * @param  \NotificationChannels\RocketChat\RocketChat $rocketChat
     * @return void
     */
    public function __construct(RocketChat $rocketChat)
    {
        $this->rocketChat = $rocketChat;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     *
     * @throws \NotificationChannels\RocketChat\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification): void
    {
        /** @var \NotificationChannels\RocketChat\RocketChatMessage $message */
        $message = $notification->toRocketChat($notifiable);

        $to = $message->getChannel() ?: $notifiable->routeNotificationFor('RocketChat');
        $to = $to ?: $this->rocketChat->getDefaultChannel();
        if ($to === null) {
            throw CouldNotSendNotification::missingTo();
        }

        $from = $message->getFrom() ?: $this->rocketChat->getToken();
        if (! $from) {
            throw CouldNotSendNotification::missingFrom();
        }

        try {
            $this->sendMessage($to, $message);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::rocketChatRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithRocketChat($exception);
        }
    }

    /**
     * @param  string  $to
     * @param  \NotificationChannels\RocketChat\RocketChatMessage  $message
     * @return void
     */
    private function sendMessage(string $to, RocketChatMessage $message): void
    {
        $this->rocketChat->sendMessage($to, $message->toArray());
    }
}
