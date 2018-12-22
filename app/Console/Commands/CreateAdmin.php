<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jet\Domain\Security\Exception\InvalidCredentialFormatException;
use Jet\Domain\Security\Exception\RegistrationFailedException;
use Jet\Domain\Security\Registration;
use Jet\Domain\Security\ValueObject\Credentials;
use Jet\Domain\Security\ValueObject\MatchingPasswords;
use Jet\Domain\Security\ValueObject\Username;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an administrator account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $displayName    = $this->ask('Display name');

            $username       = $this->ask('Username');
            $validUsername  = new Username($username);

            $password       = $this->secret('Password');
            $passwordRepeat = $this->secret('Password (Type Again)');
            $matchedPassword = (new MatchingPasswords($password, $passwordRepeat))->valildateAndGet();

            $registration = new Registration(
                new Credentials($validUsername, $matchedPassword), 
                $displayName
            );

            $registration->execute();
        } catch(InvalidCredentialFormatException $e) {
            $this->error($e->getMessage());
        } catch(RegistrationFailedException $e) {
            $this->error($e->getMessage());
        }                
    }
}
