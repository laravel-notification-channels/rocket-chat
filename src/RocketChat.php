<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

final class RocketChat
{
    /** @var \GuzzleHttp\Client */
    private $http;

    /** @var string */
    private $url;

    /** @var string */
    private $token;

    /** @var string|null */
    private $defaultChannel;

    /**
     * @param  \GuzzleHttp\Client  $http
     * @param  string  $url
     * @param  string  $token
     * @param  string|null  $defaultChannel
     * @return void
     */
    public function __construct(HttpClient $http, string $url, string $token, ?string $defaultChannel = null)
    {
        $this->http = $http;
        $this->url = rtrim($url, '/');
        $this->token = $token;
        $this->defaultChannel = $defaultChannel;
    }

    /**
     * Returns RocketChat base url.
     *
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Returns RocketChat token.
     *
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }

    /**
     * Returns default channel id or name.
     *
     * @return string|null
     */
    public function defaultChannel(): ?string
    {
        return $this->defaultChannel;
    }

    /**
     * Send a message.
     *
     * @param  string  $to
     * @param  array  $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendMessage(string $to, array $message): ResponseInterface
    {
        $url = sprintf('%s/hooks/%s', $this->url, $this->token);

        return $this->post($url, [
            'json' => array_merge($message, [
                'channel' => $to,
            ]),
        ]);
    }

    /**
     * Perform a simple post request.
     *
     * @param  string  $url
     * @param  array  $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function post(string $url, array $options): ResponseInterface
    {
        return $this->http->post($url, $options);
    }
}
