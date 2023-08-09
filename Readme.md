# Laravel Searchable

## Installation

You can install the package via composer:

```sh
composer require nahid-ferdous/laravel-searchable
```

Import in model class

```php  
use Nahid\Searchable\Traits\Searchable;
```

Usage

```php
class User extends Authenticatable
{
    use Searchable;
}
```

Publish config file

```sh
php artisan vendor:publish --provider="Nahid\Searchable\SearchableServiceProvider"
```

Example

```php
$users = User::search(request('search_query'), [
        '%name',
        '%email',
        'phone',
        'country|name',
        'country.city|name'
    ])->get();
```

%name will search name column with like operator

```php
->where('name', 'like', '%'.$searchQuery.'%')
```

```php
```
// e.g http://example.com/search?q=searchTerm