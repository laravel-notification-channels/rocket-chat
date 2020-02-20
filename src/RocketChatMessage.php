<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

class RocketChatMessage
{
    /**
     * RocketChat channel id.
     *
     * @var string
     */
    public $channel = '';

    /**
     * A user or app access token.
     *
     * @var string
     */
    public $from = '';

    /**
     * The text content of the message.
     *
     * @var string
     */
    public $content = '';

    /**
     * Create a new instance of RocketChatMessage.
     *
     * @param  string  $content
     * @return static
     */
    public static function create($content = ''): self
    {
        return new static($content);
    }

    /**
     * Create a new instance of RocketChatMessage.
     *
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->content($content);
    }

    /**
     * Set the sender's access token.
     *
     * @param  string  $accessToken
     * @return $this
     */
    public function from($accessToken): self
    {
        $this->from = $accessToken;

        return $this;
    }

    /**
     * Set the RocketChat channel the message should be sent to.
     *
     * @param  string $channel
     * @return $this
     */
    public function to($channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Set the content of the RocketChat message. Supports GitHub flavoured markdown.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get an array representation of the RocketChatMessage.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'text' => $this->content,
            'channel' => $this->channel,
        ]);
    }
}
