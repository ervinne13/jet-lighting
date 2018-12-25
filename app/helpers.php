<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Jet\Domain\System\ValueObject\NavigationNode;

if (!function_exists('active_if_current_route_is')) {

    function active_if_current_route_is($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }

}

if (!function_exists('active_if_node_route_is')) {

    function active_if_node_route_is(NavigationNode $node, $output = 'active')
    {
        if ($node->isRouteMatchingDeeply(Route::currentRouteName())) {
            return $output;
        }
    }

}

if (!function_exists('nullable_display_date')) {

    function nullable_display_date(string $baseDate = null)
    {
        return $baseDate ? with(new Carbon($baseDate))->format('m/d/Y h:i a') : '';
    }

}
