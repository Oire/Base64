# Oirë Base64, URL-safe Base64 Handling

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Oire/Base64.svg?style=flat-square)](https://packagist.org/packages/Oire/Base64)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/Oire/Base64/run-tests?label=tests)](https://github.com/Oire/Base64/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/Oire/Base64/blob/master/LICENSE)

Encodes data to Base64 URL-safe way and decodes encoded data.

## Requirements

This library requires PHP 7.3 or above.

## Installation

Install via [Composer](https://getcomposer.org/):

```
composer require oire/base64
```

## Running Tests

Run `./vendor/bin/phpunit` in the project directory.

## Compatibility with Earlier Versions of PHP
If you want a version compatible with PHP 7.1.2, please install [version 1](https://github.com/Oire/Base64/tree/v1) instead:

```shell
composer require "oire/base64 ^1"
```

## Usage Examples

```php
use Oire\Base64\Base64;
use Oire\Base64\Exception\Base64Exception;

$text = "The quick brown fox jumps over the lazy dog";
$encoded = Base64::encode($text);
echo $encoded.PHP_EOL;
```

This will output:  
```shell
VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw
```

By default, the `encode()` method truncates padding `=` signs as PHP’s built-in decoder handles this correctly. However, if the second parameter is given and set to `true`, `=` signs will be replaced with tildes (`~`), i.e.:

```php
$encoded = Base64::encode($text, true);
echo $encoded.PHP_EOL;
````

This will output:  
```shell
VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw~~
```

To decode the data, simply call `Base64::decode()`:

```php
$encoded = "VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw";

try {
    $decoded = Base64::decode($encoded);
} catch(Base64Exception $e) {
    // Handle errors
}

echo $decoded.PHP_EOL;
```

This will output:  
```shell
The quick brown fox jumps over the lazy dog
```

## License
Copyright © 2017-2020, Andre Polykanine also known as Menelion Elensúlë, [The Magical Kingdom of Oirë](https://github.com/Oire/).  
This software is licensed under an MIT license.