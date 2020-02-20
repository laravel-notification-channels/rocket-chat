<?php

declare(strict_types=1);

namespace NotificationChannels\RocketChat;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class RocketChatServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->when(RocketChatWebhookChannel::class)
            ->needs(RocketChat::class)
            ->give(function () {
                return new RocketChat(
                    new HttpClient,
                    Config::get('services.rocketchat.url'),
                    Config::get('services.rocketchat.token'),
                    Config::get('services.rocketchat.channel')
                );
            });
    }
}
