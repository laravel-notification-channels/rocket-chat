<?php

namespace NotificationChannels\RocketChat\Test;

use NotificationChannels\RocketChat\RocketChatAttachment;
use NotificationChannels\RocketChat\RocketChatMessage;
use PHPUnit\Framework\TestCase;

class RocketChatAttachmentTest extends TestCase
{
    /** @test */
    public function it_can_accept_a_config_when_constructing_an_attachment()
    {
        $attachment = new RocketChatAttachment(['title' => 'test123']);

        $this->assertEquals(['title' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_accept_a_config_when_creating_an_attachment()
    {
        $attachment = RocketChatAttachment::create(['title' => 'test123']);

        $this->assertEquals(['title' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_returns_an_empty_array_if_not_configured()
    {
        $attachment = new RocketChatAttachment();

        $this->assertEquals([], $attachment->toArray());
    }



    /** @test */
    public function it_can_set_the_color()
    {
        $attachment = new RocketChatAttachment();
        $attachment->color('#FFFFFF');

        $this->assertEquals(['color' => '#FFFFFF'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_text()
    {
        $attachment = new RocketChatAttachment();
        $attachment->text('test123');


        $this->assertEquals(['text' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_timestamp()
    {
        $attachment = new RocketChatAttachment();
        $attachment->timestamp('2020-02-19T19:00:00.000Z');

        $this->assertEquals(['ts' => '2020-02-19T19:00:00.000Z'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_timestamp_as_datetime()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s.u', '2020-02-19 19:00:00.000');
        $attachment = new RocketChatAttachment();
        $attachment->timestamp($date);


        $this->assertEquals(['ts' => '2020-02-19T19:00:00.000Z'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_thumb_url()
    {
        $attachment = new RocketChatAttachment();
        $attachment->thumbnailUrl('test123');

        $this->assertEquals(['thumb_url' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_message_link()
    {
        $attachment = new RocketChatAttachment();
        $attachment->messageLink('test123');

        $this->assertEquals(['message_link' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_collapsed()
    {
        $attachment = new RocketChatAttachment();
        $attachment->collapsed(true);

        $this->assertEquals(['collapsed' => true], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_author_name()
    {
        $attachment = new RocketChatAttachment();
        $attachment->authorName('author');

        $this->assertEquals(['author_name' => 'author'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_author_link()
    {
        $attachment = new RocketChatAttachment();
        $attachment->authorLink('test123');

        $this->assertEquals(['author_link' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_author_icon()
    {
        $attachment = new RocketChatAttachment();
        $attachment->authorIcon('test123');

        $this->assertEquals(['author_icon' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_author()
    {
        $attachment = new RocketChatAttachment();
        $attachment->author('aname', 'alink','aicon');

        $this->assertEquals([
            'author_name' => 'aname',
            'author_link' => 'alink',
            'author_icon' => 'aicon'
        ], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_title()
    {
        $attachment = new RocketChatAttachment();
        $attachment->title('test123');

        $this->assertEquals(['title' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_title_link()
    {
        $attachment = new RocketChatAttachment();
        $attachment->titleLink('test123');

        $this->assertEquals(['title_link' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_title_link_download()
    {
        $attachment = new RocketChatAttachment();
        $attachment->titleLinkDownload(true);

        $this->assertEquals(['title_link_download' => true], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_image_url()
    {
        $attachment = new RocketChatAttachment();
        $attachment->imageUrl('test123');

        $this->assertEquals(['image_url' => 'test123'], $attachment->toArray());
    }

    /** @test */
    public function it_can_set_the_audio_url()
    {
        $attachment = new RocketChatAttachment();
        $attachment->audioUrl('test123');

        $this->assertEquals(['audio_url' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_video_url()
    {
        $attachment = new RocketChatAttachment();
        $attachment->videoUrl('test123');

        $this->assertEquals(['video_url' => 'test123'], $attachment->toArray());
    }
    /** @test */
    public function it_can_set_the_fields()
    {

        $fields = [
            [
                'short' => false,
                'title' => 'test1',
                'value' => 'value1'
            ],
            [
                'short' => true,
                'title' => 'test2',
                'value' => 'value2'
            ],
        ];
        $attachment = new RocketChatAttachment();
        $attachment->fields($fields);

        $this->assertEquals(['fields' => $fields], $attachment->toArray());
    }

    /** @test */
    public function it_cannot_set_unknown_field()
    {
        $attachment = new RocketChatAttachment(['notExisting']);
        $this->assertEquals([], $attachment->toArray());
    }


}
