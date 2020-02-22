<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;
use RuntimeException;

final class CouldNotSendNotification extends RuntimeException
{
    /**
     * Thrown when channel identifier is missing.
     *
     * @return static
     */
    public static function missingTo(): self
    {
        return new static('RocketChat notification was not sent. Channel identifier is missing.');
    }

    /**
     * Thrown when user or app access token is missing.
     *
     * @return static
     */
    public static function missingFrom(): self
    {
        return new static('RocketChat notification was not sent. Access token is missing.');
    }

    /**
     * Thrown when there's a bad response from the RocketChat.
     *
     * @param  \GuzzleHttp\Exception\ClientException  $exception
     * @return static
     */
    public static function rocketChatRespondedWithAnError(ClientException $exception): self
    {
        $message = $exception->getResponse()->getBody();
        $code = $exception->getResponse()->getStatusCode();

        return new static("RocketChat responded with an error `{$code} - {$message}`");
    }

    /**
     * Thrown when we're unable to communicate with RocketChat.
     *
     * @param  \Exception  $exception
     * @return static
     */
    public static function couldNotCommunicateWithRocketChat(Exception $exception): self
    {
        return new static("The communication with RocketChat failed. Reason: {$exception->getMessage()}");
    }
}
