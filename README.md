# Base64url encoder/decoder

Base64 encoder/decoder with URL safe alphabet (base64url).

Modified Base64 with URL (and filename) safe alphabet, where the '+' and '/' characters of standard Base64 
are respectively replaced by '-' and '_', and the padding '=' signs are omitted.

See base64url reference in [RFC 4648](https://tools.ietf.org/html/rfc4648#section-5).

Given the example input *????SlashAndPlus>>>*, 
standard base64 encoded result equals to *Pz8/P1NsYXNoQW5kUGx1cz4+Pg==*, 
where base64url version produces *Pz8_P1NsYXNoQW5kUGx1cz4-Pg*.

## Requirements

The library requires PHP 5.6 or above for basic usage.

## Installation

The preferred way to install this library is through [Composer](http://getcomposer.org/download/). 
To install the latest version, run:

```
composer require olegf13/base64url
```

## Basic usage

```php
<?php
use Olegf13\Base64URL;

$inputString = '????SlashAndPlus>>>';
$encodedString = Base64URL::encode($inputString);
echo $encodedString, \PHP_EOL; // "Pz8_P1NsYXNoQW5kUGx1cz4-Pg"
echo Base64URL::decode($encodedString), \PHP_EOL; // "????SlashAndPlus>>>" 
```

## License

This library is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.