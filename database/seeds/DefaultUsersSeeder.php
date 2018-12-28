<?php

use Illuminate\Database\Seeder;
use Jet\Domain\System\Service\Builder\RegistrationBuilder;
use Jet\Domain\System\Service\RoleRepository;

class DefaultUsersSeeder extends Seeder
{
    /** @var RegistrationBuilder */
    private $registrationBuilder;

    /** @var RoleRepository */
    private $roleRepository;

    public function __construct(RegistrationBuilder $registrationBuilder, RoleRepository $roleRepository)
    {
        $this->registrationBuilder = $registrationBuilder;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->makeAdmin();
        $this->makeCSR();
        $this->makeSales();
    }

    private function makeAdmin()
    {
        $role = $this->roleRepository->findByName('Administrator');

        $registration = $this->registrationBuilder
            ->withDisplayName('Saul Goodman')
            ->withUsername('administrator')
            ->withPassword(')GUEo5875IJ("^X')
            ->withRepeatPassword(')GUEo5875IJ("^X')
            ->withRole($role)
            ->build();

        $registration->execute();
        $this->registrationBuilder->flush();
    }

    private function makeCSR()
    {
        $role = $this->roleRepository->findByName('CSR Officer');

        $registration = $this->registrationBuilder
            ->withDisplayName('Walter White')
            ->withUsername('csrofficer')
            ->withPassword('Secret!3')
            ->withRepeatPassword('Secret!3')
            ->withRole($role)
            ->build();

        $registration->execute();
        $this->registrationBuilder->flush();
    }

    private function makeSales()
    {
        $role = $this->roleRepository->findByName('Sales Officer');

        $registration = $this->registrationBuilder
            ->withDisplayName('Gus Fring')
            ->withUsername('salesofficer')
            ->withPassword('Secret!3')
            ->withRepeatPassword('Secret!3')
            ->withRole($role)
            ->build();

        $registration->execute();
        $this->registrationBuilder->flush();
    }

}
