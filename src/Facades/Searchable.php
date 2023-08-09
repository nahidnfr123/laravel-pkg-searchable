<?php

namespace Nahid\Searchable\Facades;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Nahid\Searchable\Searchable
 */
class Searchable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'searchable';
    }
}
