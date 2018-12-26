<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\ValueObject\ModuleCode;
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

    function nullable_display_date($baseDate = null)
    {
        if (!$baseDate) {
            return '';
        }

        if (is_string($baseDate)) {
            return with(new Carbon($baseDate))->format('M d, Y h:i a');
        } else {
            return $baseDate->format('M d, Y h:i a');
        }
    }

}

if (!function_exists('reserve_tracking_number')) {

    function reserve_tracking_number(string $moduleCode) : string
    {
        return tracking_number_by_module($moduleCode)->getNextAvailableStringVal();
    }

}

if (!function_exists('commit_tracking_number')) {

    function commit_tracking_number(string $moduleCode)
    {        
        return tracking_number_by_module($moduleCode)->commit();
    }

}

if (!function_exists('tracking_number_by_module')) {

    function tracking_number_by_module(string $moduleCode) : TrackingNumber
    {
        $repository = app(TrackingNumberRepository::class);
        return $repository->findByModuleCode(ModuleCode::fromString($moduleCode));        
    }

}