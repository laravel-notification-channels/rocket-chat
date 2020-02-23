<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use InvalidArgumentException;

class RocketChatAttachment
{
    /** @var string|null The color you want the order on the left side to be, any value background-css supports. */
    protected $color;

    /** @var string|null The text to display for this attachment, it is different than the message’s text. */
    protected $text;

    /** @var string|null Displays the time next to the text portion. */
    protected $timestamp;

    /** @var string|null An image that displays to the left of the text, looks better when this is relatively small. */
    protected $thumbnailUrl;

    /** @var string|null Only applicable if the ts is provided, as it makes the time clickable to this link. */
    protected $messageLink;

    /** @var bool Causes the image, audio, and video sections to be hiding when collapsed is true. */
    protected $collapsed = false;

    /** @var string|null Name of the author. */
    protected $authorName;

    /** @var string|null Providing this makes the author name clickable and points to this link. */
    protected $authorLink;

    /** @var string|null Displays a tiny icon to the left of the Author’s name. */
    protected $authorIcon;

    /** @var string|null Title to display for this attachment, displays under the author. */
    protected $title;

    /** @var string|null Providing this makes the title clickable, pointing to this link. */
    protected $titleLink;

    /** @var bool When this is true, a download icon appears and clicking this saves the link to file. */
    protected $titleLinkDownload = false;

    /** @var string|null The image to display, will be “big” and easy to see. */
    protected $imageUrl;

    /** @var string|null Audio file to play, only supports what html audio does. */
    protected $audioUrl;

    /** @var string|null Video file to play, only supports what html video does. */
    protected $videoUrl;

    /** @var array An array of Attachment Field Objects. */
    protected $fields = [];

    /**
     * RocketChatAttachment constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setPropertiesFromArray($data);
    }

    /**
     * Create a new instance of RocketChatAttachment.
     *
     * @param array $data
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public static function make(array $data = [])
    {
        return new self($data);
    }

    /**
     * @param string $color
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $text
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string|\DateTime $timestamp
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function timestamp($timestamp): self
    {
        if (! ($timestamp instanceof DateTime) && ! is_string($timestamp)) {
            $invalidType = gettype($timestamp);
            if ($invalidType === 'object') {
                $invalidType = get_class($timestamp);
            }
            throw new InvalidArgumentException(sprintf(
                'Timestamp must be string or DateTime, %s given.',
                $invalidType
            ));
        }

        if ($timestamp instanceof DateTime) {
            $date = clone $timestamp;
            $timestamp = $date->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s.v\Z');
        }

        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @param string $thumbnailUrl
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function thumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * @param string $messageLink
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function messageLink(string $messageLink): self
    {
        $this->messageLink = $messageLink;

        return $this;
    }

    /**
     * @param bool $collapsed
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function collapsed(bool $collapsed): self
    {
        $this->collapsed = $collapsed;

        return $this;
    }

    /**
     * @param string $name
     * @param string $link
     * @param string $icon
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function author(string $name, string $link = '', string $icon = ''): self
    {
        $this->authorName($name);
        $this->authorLink($link);
        $this->authorIcon($icon);

        return $this;
    }

    /**
     * @param string $authorName
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function authorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @param string $authorLink
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function authorLink(string $authorLink): self
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    /**
     * @param string $authorIcon
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function authorIcon(string $authorIcon): self
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * @param string $title
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $titleLink
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function titleLink(string $titleLink): self
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * @param bool $titleLinkDownload
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function titleLinkDownload(bool $titleLinkDownload): self
    {
        $this->titleLinkDownload = $titleLinkDownload;

        return $this;
    }

    /**
     * @param string $imageUrl
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function imageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @param string $audioUrl
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function audioUrl(string $audioUrl): self
    {
        $this->audioUrl = $audioUrl;

        return $this;
    }

    /**
     * @param string $videoUrl
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function videoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * @param array $fields
     * @return \NotificationChannels\RocketChat\RocketChatAttachment
     */
    public function fields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get an array representation of the RocketChatAttachment.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'color' => $this->color,
            'text' => $this->text,
            'ts' => $this->timestamp,
            'thumb_url' => $this->thumbnailUrl,
            'message_link' => $this->messageLink,
            'collapsed' => $this->collapsed,
            'author_name' => $this->authorName,
            'author_link' => $this->authorLink,
            'author_icon' => $this->authorIcon,
            'title' => $this->title,
            'title_link' => $this->titleLink,
            'title_link_download' => $this->titleLinkDownload,
            'image_url' => $this->imageUrl,
            'audio_url' => $this->audioUrl,
            'video_url' => $this->videoUrl,
            'fields' => $this->fields,
        ]);
    }

    /**
     * Set attachment data from array.
     *
     * @param array $data
     * @return void
     */
    private function setPropertiesFromArray(array $data): void
    {
        foreach ($data as $key => $value) {
            $methodName = Str::camel($key);

            if (! method_exists($this, $methodName)) {
                continue;
            }

            $this->{$methodName}($value);
        }
    }
}
