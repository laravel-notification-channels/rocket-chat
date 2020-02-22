<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

class RocketChatMessage
{
    /** @var string|null RocketChat channel id. */
    protected $channel = null;

    /** @var string|null A user or app access token. */
    protected $from = null;

    /** @var string The text content of the message. */
    protected $content;

    /** @var string The alias name of the message. */
    protected $alias;

    /** @var string The avatar emoji of the message. */
    protected $emoji;

    /** @var string The avatar image of the message. */
    protected $avatar;

    /** @var \NotificationChannels\RocketChat\RocketChatAttachment[] Attachments of the message. */
    protected $attachments = [];

    /**
     * Create a new instance of RocketChatMessage.
     *
     * @param  string $content
     * @return static
     */
    public static function make(string $content = ''): self
    {
        return new static($content);
    }

    /**
     * Create a new instance of RocketChatMessage.
     *
     * @param string $content
     */
    public function __construct(string $content = '')
    {
        $this->content($content);
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * Set the sender's access token.
     *
     * @param  string  $accessToken
     * @return $this
     */
    public function from(string $accessToken): self
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
    public function to(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Set the sender's alias.
     *
     * @param  string $alias
     * @return $this
     */
    public function alias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Set the sender's emoji.
     *
     * @param  string $emoji
     * @return $this
     */
    public function emoji(string $emoji): self
    {
        $this->emoji = $emoji;

        return $this;
    }

    /**
     * Set the sender's avatar.
     *
     * @param  string $avatar
     * @return $this
     */
    public function avatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Set the content of the RocketChat message.
     * Supports GitHub flavoured markdown.
     *
     * @param  string  $content
     * @return $this
     */
    public function content(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Add an attachment to the message.
     *
     * @param array|\NotificationChannels\RocketChat\RocketChatAttachment $attachment
     * @return $this
     */
    public function attachment($attachment): self
    {
        if (! ($attachment instanceof RocketChatAttachment)) {
            $attachment = new RocketChatAttachment($attachment);
        }

        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * Add multiple attachments to the message.
     *
     * @param array|\NotificationChannels\RocketChat\RocketChatAttachment[] $attachments
     * @return $this
     */
    public function attachments(array $attachments): self
    {
        foreach ($attachments as $attachment) {
            $this->attachment($attachment);
        }

        return $this;
    }

    /**
     * Clear all attachments.
     *
     * @return $this
     */
    public function clearAttachments(): self
    {
        $this->attachments = [];

        return $this;
    }

    /**
     * Get an array representation of the RocketChatMessage.
     *
     * @return array
     */
    public function toArray(): array
    {
        $attachments = [];

        foreach ($this->attachments as $attachment) {
            $attachments[] = $attachment->toArray();
        }

        return array_filter([
            'text' => $this->content,
            'channel' => $this->channel,
            'alias' => $this->alias,
            'emoji' => $this->emoji,
            'avatar' => $this->avatar,
            'attachments' => $attachments,
        ]);
    }
}
