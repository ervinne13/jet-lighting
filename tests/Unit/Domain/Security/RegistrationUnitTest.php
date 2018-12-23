<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jet\Domain\Security\Service\Builder\RegistrationBuilder;
use Jet\Domain\Security\ValueObject\Credentials;
use Jet\Domain\Security\ValueObject\MatchingPasswords;
use Jet\Domain\Security\ValueObject\Username;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_register_users_with_valid_properties()
    {
        $builder = new RegistrationBuilder();
        $registration = $builder
                ->withDisplayName('Ervinne Sodusta')
                ->withUsername('administrator')
                ->withPassword('Secret!23')
                ->withRepeatPassword('Secret!23')
                ->build();

        $registration->execute();

        $this->assertDatabaseHas('users', ['username' => 'administrator']);

        //  password should be hashed (or at least not the password anymore)
        $this->assertDatabaseMissing('users', ['password' => 'Secret!23']);
    }

}
