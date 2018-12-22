<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('active_if_current_route_is')) {

    function active_if_current_route_is($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

}