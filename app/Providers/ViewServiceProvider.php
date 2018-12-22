<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'layouts.navigation', 'App\Http\View\Composers\NavigationComposer'
        );

        View::composer(
            '*', 'App\Http\View\Composers\GlobalComposer'
        );
    }
}
