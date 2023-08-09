<?php

namespace Nahid\Searchable;

use Illuminate\Support\ServiceProvider;

class SearchableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/searchable.php' => config_path('searchable.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/searchable.php', 'searchable',);
    }
}
