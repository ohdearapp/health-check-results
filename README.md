# Create a health check report to be verified by Oh Dear

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ohdearapp/health-check-report.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/health-check-report)
[![Tests](https://github.com/ohdearapp/health-check-report/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/ohdearapp/health-check-report/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ohdearapp/health-check-report.svg?style=flat-square)](https://packagist.org/packages/ohdearapp/health-check-report)

Using this package you can build up the JSON that Oh Dear expects for the health check.

## Installation

You can install the package via composer:

```bash
composer require ohdearapp/health-check-report
```

## Usage

Here's an example that shows how you can create the JSON that Oh Dear expects for the health check.

```php
    $lines = [
        new Line(
            'name',
            'message',
            'ok',
            ['name' => 'value']
        )
    ];

    $report = new Report(
        finishedAt: new DateTimeImmutable('2001-01-01 00:00:00'),
        lines: $lines,
    );
```

This will output this JSON:

```
{"finishedAt":"2001-01-01 00:00:00","lines":[{"name":"name","message":"message","status":"ok","meta":{"name":"value"}}]}
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
