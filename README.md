# Create a health check report to be verified by Oh Dear

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/health-check-results.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/health-check-results)
[![Tests](https://github.com/ohdearapp/health-check-results/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/ohdearapp/health-check-results/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/health-check-results.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/health-check-results)

Using [Oh Dear](https://ohdear.app) you can monitor various aspects or your application and server. This way you could get alerts when:

- disk space is running low
- the database is down
- Redis cannot be reached
- mails cannot be sent
- there are many application errors in a small timeframe (via [Flare](https://flareapp.io))
- a reboot of your app is required
- ...

You can monitor any aspect of your app that you want.

Using this package you can build up the JSON that [Oh Dear](https://ohdear.app) expects for its health check. 

To learn more head over to the [Application Health Monitoring docs at Oh Dear](https://ohdear.app/docs/general/application-health-monitoring).

## Installation

You can install the package via composer:

```bash
composer require ohdearapp/health-check-results
```

## Usage

Here's an example that shows how you can create the JSON that Oh Dear expects for the health check.

```php
$checkResults = new CheckResults(DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));

$checkResult = new CheckResult(
    name: 'UsedDiskSpace',
    label: 'Used disk space',
    notificationMessage: 'Your disk is almost full (91%)',
    shortSummary: '91%',
    status: CheckResult::STATUS_FAILED,
    meta: ['used_disk_space_percentage' => 91]
);

$checkResults->addCheckResult($checkResult);
```

This will output this JSON:

```
{
    "finishedAt": 1609459200,
    "checkResults": [
        {
            "name": "UsedDiskSpace",
            "label": "Used disk space",
            "notificationMessage": "Your disk is almost full (91%)",
            "shortSummary": "91%",
            "status": "failed",
            "meta": {
                "used_disk_space_percentage": 91
            }
        }
    ]
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
