# Provide number helpers to Symfony2 projects.

Twig helpers allow to format numbers (see PHP number_format() function), and print size in human readable format (kilo, mega, etc...).

## Installation

Add it to your Symfony Project:

```
git submodule add git://github.com/MattKetmo/NumberBundle.git MyProject/vendor/bundles/Ketmo/Bundle/NumberBundle
```

Add it to your app/autoload.php:

```php
$loader->registerNamespaces(array(
    // Symfony Core Namespaces
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    // ...
    // Dependencies
    'Ketmo'            => __DIR__.'/../vendor/bundles',
    // ...
    // own Namespaces
    // ...
));
```

Add it to your app/AppKernel.php:

```php
public function registerBundles()
{
    $bundles = array(
        // Symfony Core Bundle
        new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        // ...
        // Dependencies
        new Ketmo\Bundle\NumberBundle\KetmoNumberBundle(),
        // Own Bundles
        // ...
    );

    // ...
}
```

## Usage

```
{{ mynumber | number([decimals = 0]) }}
{{ mynumber | convert(unit, [base = 1000]) }}
{{ mynumber | readable([base = 1000]) }}
// unit must be within ('k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y')
// base is 1000 or 1024 (for binary manipulation)

// Examples:
{{ 123456 | number }}                                       // 123 456
{{ 123456 | convert('k') | number(2) }}                     // 123.45
{{ 85455966208.0 | convert('M', 1024) | number(1) }} Mio    // 81 497.2 Mio
{{ 85455966208.0 | convert('G', 1024) | number(1) }} Gio    // 79.6 Gio
{{ 85455966208.0 | readable(1024) }}io                      // 79.587070 Gio
{{ 85455966208.0 | readable }}o                             // 85.455966 Go
```

Notice that without decimal value, 85455966208 is considered as an integer by Twig, which is too large for PHP 
(maximum is 2147483647 for 32-bit builds of PHP, and 9223372036854775807 for 64-bit builds).
See [`PHP_INT_MAX` and `PHP_INT_SIZE`][1].

[1]: http://www.php.net/manual/en/language.types.integer.php

## TODO

* Smart conversion (e.g. `{{ 1234 | convert('auto') | number }} {{ 1234 | unit }}` will output 1,2 k) ~ok
* Adapt number formatting to different locales (e.g. `123 456,78 => 123,456.78`) ; See also localeconv()
* Convertion between different units (decimal/binary/hexa, bit/octet, ...)