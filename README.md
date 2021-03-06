# Chatapi notifications channel for Laravel 5.4+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/csgt/notification-channel-chatapi.svg?style=flat-square)](https://packagist.org/packages/csgt/notification-channel-chatapi)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/csgt/laravel-notification-channel-chatapi.svg?style=flat-square)](https://packagist.org/packages/csgt/notification-channel-chatapi)

This package makes it easy to send [Chatapi notifications] with Laravel 5.4.

## Contents
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require csgt/notification-channel-chatapi
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\Chatapi\ChatapiProvider::class,
],
```

### Setting up your Chatapi account

Add your Chatapi Account SID, Auth Token, and From Number (optional) to your `config/services.php`:

```php
// config/services.php
...
'chatapi' => [
    'url'   => env('CHATAPI_URL'),
    'token' => env('CHATAPI_TOKEN'),
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Chatapi\ChatapiChannel;
use NotificationChannels\Chatapi\ChatapiMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [ChatapiChannel::class];
    }

    public function toChatapi($notifiable)
    {
        return (new ChatapiMessage())
            ->content("Your {$notifiable->service} account was approved!");
    }
}
```

In order to let your Notification know which phone are you sending/calling to, the channel will look for the `celular` attribute of the Notifiable model. If you want to override this behaviour, add the `routeNotificationForChatapi` method to your Notifiable model.

```php
public function routeNotificationForChatapi()
{
    return $this->mobile;
}
```

### Available Message methods

#### ChatapiSmsMessage

- `from('')`: Accepts a phone to use as the notification sender.
- `content('')`: Accepts a string value for the notification body.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email jgalindo@cs.com.gt instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [CS](https://github.com/csgt)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
