<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jet\Domain\Security\Registration;
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
        $matchedPassword = (new MatchingPasswords('Secret!23', 'Secret!23'))->valildateAndGet();
        $validUsername = new Username('administrator');
        $registration = new Registration(
            new Credentials($validUsername, $matchedPassword), 
            'Administrator Administrator'
        );

        $registration->execute();

        $this->assertDatabaseHas('users', ['username' => 'administrator']);

        //  password should be hashed (or at least not the password anymore)
        $this->assertDatabaseMissing('users', ['password' => 'Secret!23']);
    }

}
