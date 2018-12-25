<?php

use Illuminate\Database\Seeder;
use Jet\Domain\System\Entity\ModuleAccess;
use Jet\Domain\System\Entity\Role;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\ValueObject\AccessControl;
use LaravelDoctrine\ORM\Facades\EntityManager;

class DefaultRolesSeeder extends Seeder
{
    /** @var ModuleRepository */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * TODO: move entity manager calls
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $security = new Role('Security Manager');

        EntityManager::persist($security);

        $this->persistACL($security, [
            ['U', AccessControl::MANAGER],
            ['R', AccessControl::MANAGER],
        ]);

        EntityManager::flush();
    }

    private function persistACL(Role $role, $array)
    {
        foreach($array as $item) {
            $moduleAccess = new ModuleAccess(
                $this->moduleRepository->find($item[0]), 
                new AccessControl($item[1])
            );

            $moduleAccess->setRole($role);
            EntityManager::persist($moduleAccess);
        }
    }
}
