<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jet\Domain\System\Exception\InvalidCredentialFormatException;
use Jet\Domain\System\Exception\RegistrationFailedException;
use Jet\Domain\System\Service\Builder\RegistrationBuilder;

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
            $builder = new RegistrationBuilder();
            $builder->withDisplayName($this->ask('Display name'));
            $builder->withUsername($this->ask('Username'));
            $builder->withPassword($this->secret('Password'));
            $builder->withRepeatPassword($this->secret('Password (Type Again)'));           

            $registration = $builder->build();
            $registration->execute();        
        } catch(InvalidCredentialFormatException $e) {
            $this->error($e->getMessage());
        } catch(RegistrationFailedException $e) {
            $this->error($e->getMessage());
        }                
    }
}
