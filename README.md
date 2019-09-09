# Spatie Generators

This package adds `artisan:make` commands to generate an [Action](https://packagist.org/packages/spatie/laravel-queueable-action) or [Data Transfer Object](https://packagist.org/packages/spatie/data-transfer-object).

* [Refactoring to actions](https://freek.dev/1371-refactoring-to-actions)
* [Laravel queueable actions](https://stitcher.io/blog/laravel-queueable-actions)
* [Organise by domain](https://stitcher.io/blog/organise-by-domain)

## Installation

1. Install Spatie Generators

```bash
composer require ge-tracker/spatie-generators
```

2. The service provider will be automatically loaded - installation complete!

## Usage

### Generating an Action

Running the following command will generate a `TestAction` into the `app/Actions` directory.

```bash
php artisan make:action TestAction
```

The `-d` or `-m` parameters can be optionally specified to generate the action into a `Domain` or `Modules` directory. If both parameters are supplied, domain will take precedence. 

The following command will generate a `TestAction` into the `app/Domain/Example/Actions` directory.

```bash
php artisan make:action TestAction -d Example
```

### Generating a DTO

A DTO can be generated in the same way as an action, and supports both the `-d` and `-m` parameters.

```bash
php artisan make:dto TestData
```

A DTO can also be a collection of DTOs, which is handled automatically by Spatie's package. Spatie Generators will attempt to automatically decide the name of your target data object, to avoid any manual configuration.

```bash
php artisan make:dto TestDataCollection --collection
```

Will generate the following class:

```php
<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObjectCollection;

class TestDataCollection extends DataTransferObjectCollection
{
    public function current(): TestData
    {
        return parent::current();
    }
}
```

## Contributors

* [GE Tracker](https://github.com/ge-tracker)
* [Spatie](https://github.com/spatie/)