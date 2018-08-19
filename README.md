# php-string-builder

[![Build status](https://img.shields.io/travis/hiroto-k/php-string-builder/master.svg?style=flat-square)](https://travis-ci.org/hiroto-k/php-string-builder)
[![License](https://img.shields.io/github/license/hiroto-k/php-string-builder.svg?style=flat-square)](https://github.com/hiroto-k/php-string-builder/blob/master/LICENSE)

String builder class for PHP.

```php
<?php

$str = 'Your String';

// Normal PHP.
// Display 'MY STRING'.
echo mb_strtoupper(str_replace('Your', 'My', $str), 'utf-8');

// Using this library.
// Display 'MY STRING'.
use HirotoK\StringBuilder\StringBuilder;

echo StringBuilder::make($str)->replace('Your', 'My')->upcase();
```

## Requirements

- PHP 7.0 or later
- mbstring extension

## Installation

### 1, Download this library

Modify require directive in ``composer.json``.

```json
{
  "require": {
    "hiroto-k/string-builder": "1.*"
  }
}
```

OR

```bash
$ composer require hiroto-k/php-string-builder
```

### 2, Load ``vendor/autoload.php`` file

Load ``vendor/autoload.php`` in your codes.

### 3, Use ``StringBuilder`` class

```php
<?php

// Load composer packages.
require "vendor/autoload.php";

// Using StringBuilder class.
use HirotoK\StringBuilder\StringBuilder;

// Create StringBuilder object.
$sb = new StringBuilder('Your string');

// Alias of '__construct'.
// This method is useful to method chain.
$sb = StringBuilder::make('Your string');
```

## License

[MIT License](https://github.com/hiroto-k/php-string-builder/blob/master/LICENSE "MIT License")
