<?php

namespace App\Providers;

use App\Http\Controllers\ViewComposers\MenuPagesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('layouts.app', MenuPagesComposer::class);
    }
}
