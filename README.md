# Oirë Base64, URL-safe Base64 Handling

[![Build Status](https://api.travis-ci.com/Oire/Base64.svg?branch=master)](https://travis-ci.com/github/Oire/Base64)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/Oire/Base64/blob/master/LICENSE)

Encodes data to Base64 URL-safe way and decodes encoded data.  
**Note**: This package requires PHP 7.1 or above.

```php
use \Oire\Base64;
use Oire\Exception\Base64Exception;

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

## Installing
Install via [Composer](https://getcomposer.org/):

`composer require oire/base64`

## Running Tests
Run `./vendor/bin/phpunit` in the projects directory.

## License
Copyright © 2017-2020, Andre Polykanine also known as Menelion Elensúlë, [The Magical Kingdom of Oirë](https://github.com/Oire/).  
This software is licensed under an MIT license.