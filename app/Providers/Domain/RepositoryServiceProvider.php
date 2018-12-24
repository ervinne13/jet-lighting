<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\Service\UserRepository;
use Jet\Infrastructure\System\Service\ModuleRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\UserRepositoryDoctrineImpl;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, function($app) {
            return new UserRepositoryDoctrineImpl(
                $app['em'], 
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->singleton(ModuleRepository::class, function($app) {
            return new ModuleRepositoryDoctrineImpl(
                $app['em'], 
                $app['em']->getClassMetaData(Module::class)
            );
        });
    }
}
