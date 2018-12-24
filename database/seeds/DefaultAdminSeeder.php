<?php

use Illuminate\Database\Seeder;
use Jet\Domain\System\Service\Builder\RegistrationBuilder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $builder = new RegistrationBuilder();
        $builder->withDisplayName('Administrator');
        $builder->withUsername('administrator');
        $builder->withPassword(')GUEo5875IJ("^X');
        $builder->withRepeatPassword(')GUEo5875IJ("^X');

        $registration = $builder->build();
        $registration->execute();
    }
}
