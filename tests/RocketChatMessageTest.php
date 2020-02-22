<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat\Test;

use NotificationChannels\RocketChat\RocketChatAttachment;
use NotificationChannels\RocketChat\RocketChatMessage;
use PHPUnit\Framework\TestCase;

final class RocketChatMessageTest extends TestCase
{
    /** @test */
    public function it_can_accept_a_content_when_constructing_a_message(): void
    {
        $message = new RocketChatMessage('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_accept_a_content_when_creating_a_message(): void
    {
        $message = RocketChatMessage::make('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_content(): void
    {
        $message = (new RocketChatMessage())->content('hello');

        $this->assertEquals('hello', $message->content);
    }

    /** @test */
    public function it_can_set_the_channel(): void
    {
        $message = (new RocketChatMessage())->to('channel');

        $this->assertEquals('channel', $message->channel);
    }

    /** @test */
    public function it_can_set_the_from(): void
    {
        $message = (new RocketChatMessage())->from('token');

        $this->assertEquals('token', $message->from);
    }

    /** @test */
    public function it_can_set_the_alias(): void
    {
        $message = (new RocketChatMessage())->alias('alias');

        $this->assertEquals('alias', $message->alias);
    }

    /** @test */
    public function it_can_set_the_emoji(): void
    {
        $message = (new RocketChatMessage())->emoji(':emoji:');

        $this->assertEquals(':emoji:', $message->emoji);
    }

    /** @test */
    public function it_can_set_the_avatar(): void
    {
        $message = (new RocketChatMessage())->avatar('avatar_img');

        $this->assertEquals('avatar_img', $message->avatar);
    }

    /** @test */
    public function it_can_set_attachment(): void
    {
        $attachment = RocketChatAttachment::make(['title' => 'test']);
        $message = (new RocketChatMessage())->attachment($attachment);

        $this->assertSame($attachment, $message->attachments[0]);
    }

    /** @test */
    public function it_can_set_attachment_as_array(): void
    {
        $message = (new RocketChatMessage())->attachment(['title' => 'test']);
        $this->assertInstanceOf(RocketChatAttachment::class, $message->attachments[0]);
    }

    /** @test */
    public function it_can_set_multiple_attachments(): void
    {
        $message = (new RocketChatMessage())->attachments([
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
        ]);
        $this->assertInstanceOf(RocketChatAttachment::class, $message->attachments[0]);
        $this->assertCount(3, $message->attachments);
    }

    /** @test */
    public function it_can_clear_attachments(): void
    {
        $message = (new RocketChatMessage())->attachments([
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
        ]);

        $message->clearAttachments();
        $this->assertCount(0, $message->attachments);
    }
}
