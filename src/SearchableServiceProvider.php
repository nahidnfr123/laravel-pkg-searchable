<?php

namespace Nahid\Searchable;

use Illuminate\Support\ServiceProvider;
use Nahid\Searchable\Traits\Searchable;

class SearchableServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $this->app->bind('searchable', function () {
//                return new Searchable();
//        });
        $this->mergeConfigFrom(
            __DIR__ . '/../config/searchable.php', config_path('searchable.php'),
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/searchable.php' => config_path('searchable.php'),
        ]);
    }
}
