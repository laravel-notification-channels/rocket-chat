# Change log

All notable changes to `laravel-notification-channels/rocket-chat` will be documented in this file

## [Unreleased]

## [0.3.0] - 2020-09-09

### Added

- ([#17]) Added Laravel 8 support

## [0.2.0] - 2020-04-26

### Added

- ([#14]) Added Laravel 7 support
- ([#7]) Method `getChannel` added to `NotificationChannels\RocketChat\RocketChatMessage` class
- ([#7]) Method `getFrom` added to `NotificationChannels\RocketChat\RocketChatMessage` class

### Changed

- ([#7]) Method `channel` renamed to `getDefaultChannel` in `NotificationChannels\RocketChat\RocketChat` class
- ([#7]) Method `token` renamed to `getToken` in `NotificationChannels\RocketChat\RocketChat` class
- ([#7]) Method `setFromArray` renamed to `setPropertiesFromArray` in `NotificationChannels\RocketChat\RocketChatAttachment` class

### Fixed

- ([#9]) Allow the use of `DateTimeImmutable` argument in `timestamp` method of `NotificationChannels\RocketChat\RocketChatAttachment` class

### Removed

- ([#7]) Method `url` removed from `NotificationChannels\RocketChat\RocketChat` class
- ([#10]) Method `clearAttachments` removed from `NotificationChannels\RocketChat\RocketChatMessage` class

## 0.1.0 - 2020-02-21

- Initial release

[Unreleased]: https://github.com/laravel-notification-channels/rocket-chat/compare/v0.3.0...master
[0.3.0]: https://github.com/cybercog/laravel-love/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/cybercog/laravel-love/compare/v0.1.0...v0.2.0

[#17]: https://github.com/laravel-notification-channels/rocket-chat/pull/17
[#14]: https://github.com/laravel-notification-channels/rocket-chat/pull/14
[#10]: https://github.com/laravel-notification-channels/rocket-chat/pull/10
[#9]: https://github.com/laravel-notification-channels/rocket-chat/pull/9
[#7]: https://github.com/laravel-notification-channels/rocket-chat/pull/7
