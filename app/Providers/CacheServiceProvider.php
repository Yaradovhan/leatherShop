<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{


    public function register()
    {

    }

    public function boot()
    {
    }

    public function registerFlush($class): void
    {
        $flush = function () use ($class) {
            Cache::tags($class)->flush();
        };
        /**
         * @var Model $class
         */
        $class::created($flush);
        $class::saved($flush);
        $class::updated($flush);
        $class::deleted($flush);
    }
}
