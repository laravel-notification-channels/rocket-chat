<?php

namespace NotificationChannels\RocketChat;

use Illuminate\Support\Str;

/**
 * Class RocketChatAttachment.
 */
class RocketChatAttachment
{
    /**
     * @var string The color you want the order on the left side to be, any value background-css supports.
     */
    protected $color = '';

    /**
     * @var string The text to display for this attachment, it is different than the message’s text.
     */
    protected $text = '';
    /**
     * @var string Displays the time next to the text portion.
     */
    protected $timestamp = '';
    /**
     * @var string An image that displays to the left of the text, looks better when this is relatively small.
     */
    protected $thumbnailUrl = '';
    /**
     * @var string Only applicable if the ts is provided, as it makes the time clickable to this link.
     */
    protected $messageLink = '';
    /**
     * @var bool Causes the image, audio, and video sections to be hiding when collapsed is true.
     */
    protected $collapsed = false;
    /**
     * @var string Name of the author.
     */
    protected $authorName = '';
    /**
     * @var string Providing this makes the author name clickable and points to this link.
     */
    protected $authorLink = '';
    /**
     * @var string Displays a tiny icon to the left of the Author’s name.
     */
    protected $authorIcon = '';
    /**
     * @var string Title to display for this attachment, displays under the author.
     */
    protected $title = '';
    /**
     * @var string Providing this makes the title clickable, pointing to this link.
     */
    protected $titleLink = '';
    /**
     * @var bool When this is true, a download icon appears and clicking this saves the link to file.
     */
    protected $titleLinkDownload = false;
    /**
     * @var string The image to display, will be “big” and easy to see.
     */
    protected $imageUrl = '';
    /**
     * @var string Audio file to play, only supports what html audio does.
     */
    protected $audioUrl = '';
    /**
     * @var string Video file to play, only supports what html video does.
     */
    protected $videoUrl = '';
    /**
     * @var array An array of Attachment Field Objects.
     */
    protected $fields = [];

    /**
     * RocketChatAttachment constructor.
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        if ($config != null) {
            $this->setFromArray($config);
        }
    }

    /**
     * Create a new instance of RocketChatAttachment.
     *
     * @param array|null $config
     * @return RocketChatAttachment
     */
    public static function create(array $config = null)
    {
        return new self($config);
    }

    /**
     * set attachment data form array.
     *
     * @param array $data
     */
    protected function setFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $method = Str::camel($key);
            if (! method_exists($this, $method)) {
                continue;
            }
            $this->{$method}($value);
        }
    }

    /**
     * @param string $color
     * @return RocketChatAttachment
     */
    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $text
     * @return RocketChatAttachment
     */
    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string|\DateTime $timestamp
     * @return RocketChatAttachment
     */
    public function timestamp($timestamp): self
    {
        if (! ($timestamp instanceof \DateTime) && ! is_string($timestamp)) {
            throw new \InvalidArgumentException('Timestamp must be string or DateTime, '.gettype($timestamp).' given.');
        }

        if ($timestamp instanceof \DateTime) {
            $date = clone $timestamp;
            $timestamp = $date->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d\TH:i:s.v\Z');
        }
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @param string $thumbnailUrl
     * @return RocketChatAttachment
     */
    public function thumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * @param string $messageLink
     * @return RocketChatAttachment
     */
    public function messageLink(string $messageLink): self
    {
        $this->messageLink = $messageLink;

        return $this;
    }

    /**
     * @param bool $collapsed
     * @return RocketChatAttachment
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
     * @return RocketChatAttachment
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
     * @return RocketChatAttachment
     */
    public function authorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @param string $authorLink
     * @return RocketChatAttachment
     */
    public function authorLink(string $authorLink): self
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    /**
     * @param string $authorIcon
     * @return RocketChatAttachment
     */
    public function authorIcon(string $authorIcon): self
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * @param string $title
     * @return RocketChatAttachment
     */
    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $titleLink
     * @return RocketChatAttachment
     */
    public function titleLink(string $titleLink): self
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * @param bool $titleLinkDownload
     * @return RocketChatAttachment
     */
    public function titleLinkDownload(bool $titleLinkDownload): self
    {
        $this->titleLinkDownload = $titleLinkDownload;

        return $this;
    }

    /**
     * @param string $imageUrl
     * @return RocketChatAttachment
     */
    public function imageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @param string $audioUrl
     * @return RocketChatAttachment
     */
    public function audioUrl(string $audioUrl): self
    {
        $this->audioUrl = $audioUrl;

        return $this;
    }

    /**
     * @param string $videoUrl
     * @return RocketChatAttachment
     */
    public function videoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * @param array $fields
     * @return RocketChatAttachment
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
        $message = array_filter([
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

        return $message;
    }
}
