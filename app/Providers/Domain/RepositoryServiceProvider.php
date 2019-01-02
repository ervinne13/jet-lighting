<?php

namespace App\Providers\Domain;

use Illuminate\Support\ServiceProvider;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Entity\ItemCategory;
use Jet\Domain\PLD\Entity\Supplier;
use Jet\Domain\PLD\Service\ItemCategoryRepository;
use Jet\Domain\PLD\Service\ItemRepository;
use Jet\Domain\PLD\Service\SupplierRepository;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\Service\RoleRepository;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\Service\UserRepository;
use Jet\Infrastructure\PLD\Service\ItemCategoryRepositoryDoctrineImpl;
use Jet\Infrastructure\PLD\Service\ItemRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\ModuleRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\RoleRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\SupplierRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\TrackingNumberRepositoryDoctrineImpl;
use Jet\Infrastructure\System\Service\UserRepositoryDoctrineImpl;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * TODO: extract services later
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

        $this->app->singleton(TrackingNumberRepository::class, function($app) {
            return new TrackingNumberRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(TrackingNumber::class)
            );
        });

        $this->app->singleton(SupplierRepository::class, function($app) {
            return new SupplierRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(Supplier::class)
            );
        });

        $this->app->singleton(ItemRepository::class, function($app) {
            return new ItemRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(Item::class)
            );
        });

        $this->app->singleton(ItemCategoryRepository::class, function($app) {
            return new ItemCategoryRepositoryDoctrineImpl(
                ...$this->getDoctrineRepositoryParams(ItemCategory::class)
            );
        });
    }

    private function getDoctrineRepositoryParams($class)
    {
        return [$this->app['em'], $this->app['em']->getClassMetaData($class)];
    }
}
