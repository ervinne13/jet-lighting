<?php

namespace Tests\Unit\Domain\System\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Entity\User;
use Jet\Domain\System\Exception\RegistrationFailedException;
use Jet\Domain\System\Service\Builder\RegistrationBuilder;
use Jet\Domain\System\Service\UserRepository;
use Jet\Domain\System\ValueObject\Credentials;
use Jet\Domain\System\ValueObject\MatchingPasswords;
use Jet\Domain\System\ValueObject\Username;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Tests\RefreshDoctrineDatabase;
use Tests\TestCase;

class RegistrationUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var UserRepository
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->repository = $this->app->make(UserRepository::class);
    }

    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[DatabaseMigrations::class])) {
            $this->runDatabaseMigrations();
        }

        return $uses;
    }

    /**
     * @test
     */
    public function it_can_register_users_with_valid_properties()
    {
        $role = new Role('dummy role');
        EntityManager::persist($role);

        $builder = new RegistrationBuilder();
        $registration = $builder
                ->withDisplayName('Ervinne Sodusta')
                ->withUsername('ervinne13')
                ->withPassword('Secret!23')
                ->withRepeatPassword('Secret!23')
                ->withRole($role)
                ->build();

        $registration->execute();

        $user = $this->repository->findByUsername(new Username('ervinne13'));
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('ervinne13', $user->getUsername());
        $this->assertEquals('Ervinne Sodusta', $user->getName());
    }

    /**
     * @test
     */
    public function it_fails_to_register_existing_user()
    {
        $role = new Role('dummy role');
        EntityManager::persist($role);

        $builder = new RegistrationBuilder();
        $registration = $builder
                ->withDisplayName('Ervinne Sodusta')
                ->withUsername('ervinne13')
                ->withPassword('Secret!23')
                ->withRepeatPassword('Secret!23')
                ->withRole($role)
                ->build();

        $registration->execute();

        $this->expectException(RegistrationFailedException::class);
        $this->expectExceptionCode(RegistrationFailedException::USERNAME_ALREADY_EXIST);

        $registration->execute();
    }

}
