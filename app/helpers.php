<?php

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
