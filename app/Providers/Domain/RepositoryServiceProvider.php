<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\Service\RoleRepository;
use Jet\Domain\System\Service\UserRepository;
use Jet\Infrastructure\System\Service\ModuleRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\RoleRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\UserRepositoryDoctrineImpl;
use LaravelDoctrine\ORM\Facades\EntityManager;

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
                ...$this->getDoctrineRepositoryParams(User::class)
            );
        });

        $this->app->singleton(ModuleRepository::class, function($app) {
            return new ModuleRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(Module::class)
            );
        });

        $this->app->singleton(RoleRepository::class, function($app) {
            return new RoleRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(Role::class)
            );
        });
    }

    private function getDoctrineRepositoryParams($class)
    {
        return [$this->app['em'], $this->app['em']->getClassMetaData($class)];
    }
}
