<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;
use Jet\Domain\System\ValueObject\NavigationTree;
use Jet\Infrastructure\System\Service\NavigationTreeBuilderArrayImpl;

class NavigationTreeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $builder = new NavigationTreeBuilderArrayImpl();

        $this->app->bind(NavigationTree::class, function() use ($builder) {            
            return $builder->createFrom(config('navigation'));
        });
    }
}
