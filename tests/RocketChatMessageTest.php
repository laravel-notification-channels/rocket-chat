<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat\Test;

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
        $message = RocketChatMessage::create('hello');

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
}
