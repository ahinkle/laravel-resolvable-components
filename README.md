# Auto Resolvable Laravel Blade Components

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahinkle/auto-resolvable-bladec-omponents.svg?style=flat-square)](https://packagist.org/packages/ahinkle/auto-resolvable-bladec-omponents)
[![Total Downloads](https://img.shields.io/packagist/dt/ahinkle/auto-resolvable-bladec-omponents.svg?style=flat-square)](https://packagist.org/packages/ahinkle/auto-resolvable-bladec-omponents)

Automatically resolve your Blade Component views based on the component class names to allow for cleaner components. 

This package was built on common architecture patterns between Laravel Components and Livewire Components. Livewire automatically resolves the Blade Views whereas Laravel Components do not and require the `render()` method. This simple but useful package solves that.

```php
<?php

namespace App\View\Components;

use Ahinkle/AutoResolvableComponents/AutoResolvableComponent;

class Alert extends AutoResolvableComponent
{
    //
}
```

Will automatically render the view: `components.alert`.


## Installation

You can install the package via composer:

```bash
composer require ahinkle/auto-resolvable-blade-components
```

## Usage

Simply extend the `AutoResolvableComponent` class (vs. `component`) on your Blade Component:

```php
use Ahinkle/AutoResolvableComponents/AutoResolvableComponent;

class Alert extends AutoResolvableComponent
{
    //
    ....
```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ahinkle10@gmail.com instead of using the issue tracker.

## Credits

- [Andy Hinkle](https://github.com/ahinkle)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.