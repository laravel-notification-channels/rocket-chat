# Rocket.Chat Laravel Notifications Channel

![cog-laravel-rocket-chat-notification-channel](https://user-images.githubusercontent.com/1849174/74969369-87649980-542d-11ea-9692-c6f7ba68e2bf.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/rocket-chat.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/rocket-chat)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/rocket-chat/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/rocket-chat)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/rocket-chat.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/rocket-chat)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/rocket-chat/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/rocket-chat/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/rocket-chat.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/rocket-chat)

## Introduction

This package makes it easy to send notifications using [RocketChat](https://rocket.chat/) with Laravel 5.6+. 

## Contents

- [Installation](#installation)
	- [Setting up the RocketChat service](#setting-up-the-rocketchat-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [Change log](#changelog)
- [License](#license)

## Installation

You can install the package via composer:

```shell script
$ composer require laravel-notification-channels/rocket-chat
```

### Setting up the RocketChat service

In order to send message to RocketChat channels, you need to obtain [Webhook](https://rocket.chat/docs/administrator-guides/integrations#how-to-create-a-new-incoming-webhook).

Add your RocketChat API server's base url, incoming Webhook Token and optionally the default channel to your `config/services.php`:

```php
// config/services.php
...
'rocketchat' => [
     // Base URL for RocketChat API server (https://your.rocketchat.server.com)
    'url' => env('ROCKETCHAT_URL'),
    'token' => env('ROCKETCHAT_TOKEN'),
    // Default channel (optional)
    'channel' => env('ROCKETCHAT_CHANNEL'),
],
...
```

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\RocketChat\RocketChatMessage;
use NotificationChannels\RocketChat\RocketChatWebhookChannel;

class TaskCompleted extends Notification
{
    public function via($notifiable): array
    {
        return [
            RocketChatWebhookChannel::class,
        ];
    }

    public function toRocketChat($notifiable): RocketChatMessage
    {
        return RocketChatMessage::create("Test message")
            ->to('channel_name') // optional if set in config
            ->from('webhook_token'); // optional if set in config
    }
}
```

In order to let your notification know which RocketChat channel you are targeting, add the `routeNotificationForRocketChat` method to your Notifiable model:

```php
public function routeNotificationForRocketChat(): string
{
    return 'channel_name';
}
```

### Available methods

`from()`: Sets the sender's access token.

`to()`: Specifies the channel id to send the notification to (overridden by `routeNotificationForRocketChat` if empty).

`content()`: Sets a content of the notification message. Supports Github flavoured markdown.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```shell script
$ vendor/bin/phpunit
```

## Security

If you discover any security related issues, please email open@cybercog.su instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Anton Komarev]
- [All Contributors](../../contributors)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## About CyberCog

[CyberCog](https://cybercog.su) is a Social Unity of enthusiasts. Research best solutions in product & software development is our passion.

![cybercog-logo](https://cloud.githubusercontent.com/assets/1849174/18418932/e9edb390-7860-11e6-8a43-aa3fad524664.png)

[Anton Komarev]: https://komarev.com
