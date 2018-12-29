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
        $this->createAdmin();
        $this->createGeneralManager();
        $this->createCSROfficer();
        $this->createSales();

        EntityManager::flush();
    }

    private function createAdmin()
    {
        $admin = new Role('Administrator');
        EntityManager::persist($admin);
        $this->persistACL($admin, [
            ['U', AccessControl::MANAGER],
            ['R', AccessControl::MANAGER],            
            ['I', AccessControl::MANAGER],
            ['TN', AccessControl::MANAGER],
        ]);
    }

    private function createGeneralManager()
    {
        $gm = new Role('General Manager');
        EntityManager::persist($gm);
        $this->persistACL($gm, [
            ['C', AccessControl::MANAGER],
            ['I', AccessControl::MANAGER],
            ['TN', AccessControl::MANAGER],
            ['CQ', AccessControl::MANAGER],
            ['RQ', AccessControl::MANAGER],
            ['PO', AccessControl::MANAGER],
            ['QA', AccessControl::MANAGER],
            ['SI', AccessControl::MANAGER],
        ]);
    }

    private function createCSROfficer()
    {
        $csr = new Role('CSR Officer');
        EntityManager::persist($csr);
        $this->persistACL($csr, [
            ['C', AccessControl::MANAGER],
            ['CQ', AccessControl::AUTHOR],
            ['RQ', AccessControl::AUTHOR],
            ['PO', AccessControl::AUTHOR],
            ['QA', AccessControl::AUTHOR],
            ['SI', AccessControl::AUTHOR],
        ]);
    }

    private function createSales()
    {
        $sales = new Role('Sales Officer');
        EntityManager::persist($sales);
        $this->persistACL($sales, [
            ['C', AccessControl::MANAGER],
            ['RQ', AccessControl::AUTHOR],
            ['PO', AccessControl::AUTHOR],
        ]);
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
