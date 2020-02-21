<?php

namespace NotificationChannels\RocketChat\Test;

use NotificationChannels\RocketChat\RocketChatAttachment;
use NotificationChannels\RocketChat\RocketChatMessage;
use PHPUnit\Framework\TestCase;

class RocketChatMessageTest extends TestCase
{
    /** @test */
    public function it_can_accept_a_content_when_constructing_a_message()
    {
        $message = new RocketChatMessage('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_accept_a_content_when_creating_a_message()
    {
        $message = RocketChatMessage::create('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_content()
    {
        $message = (new RocketChatMessage())->content('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_room()
    {
        $message = (new RocketChatMessage())->to('room');

        $this->assertEquals('room', $message->room);
    }

    /** @test */
    public function it_can_set_the_from()
    {
        $message = (new RocketChatMessage())->from('token');

        $this->assertEquals('token', $message->from);
    }

    /** @test */
    public function it_can_set_the_alias()
    {
        $message = (new RocketChatMessage())->alias('alias');

        $this->assertEquals('alias', $message->alias);
    }

    /** @test */
    public function it_can_set_the_emoji()
    {
        $message = (new RocketChatMessage())->emoji(':emoji:');

        $this->assertEquals(':emoji:', $message->emoji);
    }

    /** @test */
    public function it_can_set_the_avatar()
    {
        $message = (new RocketChatMessage())->avatar('avatar_img');

        $this->assertEquals('avatar_img', $message->avatar);
    }

    /** @test */
    public function it_can_set_attachment()
    {
        $attachment = RocketChatAttachment::create(['title' => 'test']);
        $message = (new RocketChatMessage())->attachment($attachment);

        $this->assertSame($attachment, $message->attachments[0]);
    }

    /** @test */
    public function it_can_set_attachment_as_array()
    {
        $message = (new RocketChatMessage())->attachment(['title' => 'test']);
        $this->assertInstanceOf(RocketChatAttachment::class, $message->attachments[0]);
    }

    /** @test */
    public function it_can_set_multiple_attachments()
    {
        $message = (new RocketChatMessage())->attachments([
            RocketChatAttachment::create(),
            RocketChatAttachment::create(),
            RocketChatAttachment::create(),
        ]);
        $this->assertInstanceOf(RocketChatAttachment::class, $message->attachments[0]);
        $this->assertCount(3, $message->attachments);
    }

    /** @test */
    public function it_can_clear_attachments()
    {
        $message = (new RocketChatMessage())->attachments([
            RocketChatAttachment::create(),
            RocketChatAttachment::create(),
            RocketChatAttachment::create(),
        ]);

        $message->clearAttachments();
        $this->assertCount(0, $message->attachments);
    }
}
