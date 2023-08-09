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
php artisan vendor:publish --provider="nahid-ferdous/laravel-searchable"
```

// e.g search url http://example.com/users?search_query=searchTerm

Example In single Model:-

```php
# Usage:
$searchQuery = request('search_query');
$users = User::search($searchQuery, [
        '%name',
        '%email',
        'phone',
    ])->get();

# Output:
User::where('name', 'like', '%'.$searchQuery.'%')
    ->orWhere('email', 'like', '%'.$searchQuery.'%')
    ->orWhere('phone', $searchQuery)
    ->get();
```

Example with relation:-

```php
# Usage: 
$searchQuery = request('search_query'); // e.g. 'bangladesh'
$users = User::search($searchQuery, [
        '%name',
        '%email',
        '%phone',
        'country|%name',
        'country.city|%$name'
    ])->get();

# Output:
User::where('name', 'like', '%'.$searchQuery.'%')
    ->orWhere('email', 'like', '%'.$searchQuery.'%')
    ->orWhere('phone', 'like', '%'.$searchQuery.'%')
    ->orWhereHas('country', function ($query) use ($searchQuery) {
        $query->where('name', 'like', '%'.$searchQuery.'%');
    })
    ->orWhereHas('country.city', function ($query) use ($searchQuery) {
        $query->where('name', 'like', '%'.$searchQuery.'%');
    })
    ->get();
```

Example of search joining columns:-

```php
# Usage:
$searchQuery = request('search_query');
$users = User::search($searchQuery, [
        '%first_name',
        '%last_name',
        '%first_name+last_name',
    ])->get();


# Output:
User::where('first_name', 'like', '%'.$searchQuery.'%')
    ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
    ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%" . $searchQuery . "%");
    ->get();
```

Example of searching multiple conditions:-

```php
# Usage:
$searchQuery = request('search_query');
$status = request('status');
$users = User::search($searchQuery, [
        '%first_name',
        '%last_name',
        '%first_name+last_name',
    ])
    ->search(request('status'), ['status'])
    ->get();


# Output:
User::where('first_name', 'like', '%'.$searchQuery.'%')
    ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
    ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%" . $searchQuery . "%")
    ->where('status', $status)
    ->get();
```

Example Date Search:-

```php
# Usage:
$status = request('status');
$date = request('date'); // e.g. 2020-01-01 
$users = User::search($status, ['status'])
    ->searchDate($date, ['created_at'], '>');
    ->get();

# Output:
User::where('status', $status)
    ->whereDate('created_at', '>', $date)
    ->get();
```

Example Date Range Search:-

```php
# Usage:
$status = request('status');
$dateRange = request('date_range'); // e.g. 2020-01-01 - 2020-01-31 // Must be separated by space and -
$users = User::search($status, ['status'])
    ->searchDate($dateRange, ['created_at'], '><');
    ->get();

# Output:
$startDate = explode(' - ', $dateRange)[0];
$endDate = explode(' - ', $dateRange)[1];
User::where('status', $status)
    ->whereDate('created_at', '>=', $startDate)
    ->whereBetween('created_at', '<=', $endDate)
     $query->orWhereBetween($relationAttribute, $searchTerm);
    ->get();
```
