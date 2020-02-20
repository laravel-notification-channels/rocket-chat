<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

final class RocketChat
{
    /** @var \GuzzleHttp\Client */
    protected $http;

    /** @var string */
    protected $url;

    /** @var string */
    protected $token;

    /** @var string */
    protected $channel;

    /**
     * @param  \GuzzleHttp\Client  $http
     * @param  string  $url
     * @param  string  $token
     * @param  string  $channel
     * @return void
     */
    public function __construct(HttpClient $http, $url, $token, $channel)
    {
        $this->http = $http;
        $this->url = rtrim($url, '/');
        $this->token = $token;
        $this->channel = $channel;
    }

    /**
     * Returns default channel id or name.
     *
     * @return string
     */
    public function channel(): string
    {
        return $this->channel;
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
     * Send a message.
     *
     * @param  string|int  $to
     * @param  array  $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendMessage($to, $message): ResponseInterface
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
    private function post($url, $options): ResponseInterface
    {
        return $this->http->post($url, $options);
    }
}
