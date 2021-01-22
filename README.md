# Utalk notification channel for Laravel

This package makes it easy to send [Utalk](https://utalk.umbler.com/) messages using the Laravel notification system. Supports 5.5+, 6.x, 7.x and 8.x.

## Contents

-   [Installation](#installation)
-   [Usage](#usage)
    -   [Available Message methods](#available-message-methods)
-   [Changelog](#changelog)
-   [Testing](#testing)
-   [Security](#security)
-   [Contributing](#contributing)
-   [Credits](#credits)
-   [License](#license)

## Installation

You can install the package via composer:

```bash
composer require powertic/utalk-notification-channel
```

## Setup

Add your Utalk token on `app/services.php` file. You can get your API Token [here](https://utalk.umbler.com/site/api/enviarmensagem).

```php
...

'utalk' => [
    'token' => env('UTALK_TOKEN'),
],
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use Powertic\Utalk\UtalkChannel;
use Powertic\Utalk\UtalkMessage;
use Illuminate\Notifications\Notification;

class TeamCreated extends Notification
{
    public function via($notifiable)
    {
        return [UtalkChannel::class];
    }

    public function toUtalk($notifiable)
    {
        return UtalkMessage::create()
            ->message("Hello World!");
    }
}
```

In order to let your Notification know which number should receive the message, add the `routeNotificationForUtalk` method to your Notifiable model.

This method needs to return the mobile number where the notification will be sent.

```php
public function routeNotificationForUtalk()
{
    return $this->mobile;
}
```

### Available methods

-   `message('Hello World!')`: Accepts a string as message to send.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
$ composer test
```

## Security

If you discover any security related issues, please email luizeof@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Luiz Eduardo (@luizeof)](https://github.com/luizeof)
-   [Powertic](https://github.com/powerticmkt)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
