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
        $message = new RocketChatMessage('test-content');

        $this->assertSame(['text' => 'test-content'], $message->toArray());
    }

    /** @test */
    public function it_can_accept_a_content_when_creating_a_message(): void
    {
        $message = RocketChatMessage::make('test-content');

        $this->assertSame(['text' => 'test-content'], $message->toArray());
    }

    /** @test */
    public function it_can_set_the_content(): void
    {
        $message = (new RocketChatMessage())->content('test-content');

        $this->assertSame(['text' => 'test-content'], $message->toArray());
    }

    /** @test */
    public function it_can_set_the_channel(): void
    {
        $message = (new RocketChatMessage())->to('test-channel');

        $this->assertSame('test-channel', $message->getChannel());
    }

    /** @test */
    public function it_can_set_the_from(): void
    {
        $message = (new RocketChatMessage())->from('test-token');

        $this->assertSame('test-token', $message->getFrom());
    }

    /** @test */
    public function it_can_set_the_alias(): void
    {
        $message = (new RocketChatMessage())->alias('test-alias');

        $this->assertSame(['alias' => 'test-alias'], $message->toArray());
    }

    /** @test */
    public function it_can_set_the_emoji(): void
    {
        $message = (new RocketChatMessage())->emoji(':emoji:');

        $this->assertSame(['emoji' => ':emoji:'], $message->toArray());
    }

    /** @test */
    public function it_can_set_the_avatar(): void
    {
        $message = (new RocketChatMessage())->avatar('avatar_img');

        $this->assertSame(['avatar' => 'avatar_img'], $message->toArray());
    }

    /** @test */
    public function it_can_set_attachment(): void
    {
        $attachment = RocketChatAttachment::make(['title' => 'test']);
        $message = (new RocketChatMessage())->attachment($attachment);

        $this->assertSame($attachment->toArray(), $message->toArray()['attachments'][0]);
    }

    /** @test */
    public function it_can_set_attachment_as_array(): void
    {
        $message = (new RocketChatMessage())->attachment(['title' => 'test']);

        $this->assertSame(['title' => 'test'], $message->toArray()['attachments'][0]);
    }

    /** @test */
    public function it_can_set_multiple_attachments(): void
    {
        $message = (new RocketChatMessage())->attachments([
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
            RocketChatAttachment::make(),
        ]);

        $this->assertCount(3, $message->toArray()['attachments']);
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

        $this->assertArrayNotHasKey('attachments', $message->toArray());
    }
}
