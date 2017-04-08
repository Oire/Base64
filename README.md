# URL-safe Base64 Handling

[![Build Status](https://travis-ci.org/Oire/base64.svg?branch=master)](https://travis-ci.org/Oire/base64)
[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/Oire/base64/blob/master/LICENSE)

Encodes data to Base64 URL-safe way and decodes encoded data.  
**Note**: This package requires PHP 7.1 or above.

```php
use \Oire\Base64;
$text = "The quick brown fox jumps over the lazy dog";
try {
	$encoded = Base64::encode($text);
} catch(Exception $e) {
	// Handle errors
}
echo $encoded.PHP_EOL;
```

This will output:  
`VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw`

By default, the `encode()` method truncates padding `=` signs as PHP’s built-in decoder handles this correctly. However, if the second parameter is given and set to `true`, `=` signs will be replaced with tildes (`~`), i.e.:

```php
try {
	$encoded = Base64::encode($text, true);
} catch(Exception $e) {
	// Handle errors
}
echo $encoded.PHP_EOL;
````

This will output:  
`VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw~~`

To decode the data, simply call `decode()`:

```php
$encoded = "VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw";
try {
	$decoded = Base64::decode($encoded);
} catch(Exception $e) {
	// Handle errors
}
echo $decoded.PHP_EOL;
```

This will output:  
`The quick brown fox jumps over the lazy dog`

## Installing
Via [Composer](https://getcomposer.org/):

`composer require oire/base64`

or manually:

`require_once("oire/base64.php");`

## Running Tests
Run `phpunit` in the projects directory.

## License
Copyright © 2017, Andre Polykanine also known as Menelion Elensúlë.  
This software is licensed under an MIT license.