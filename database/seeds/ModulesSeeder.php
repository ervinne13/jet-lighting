<?php

use Illuminate\Database\Seeder;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\ValueObject\ModuleCode;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleDataList = [
            ['U', 'User Management'],
            ['R', 'Role Management'],
            ['TN', 'Tracking Number Management'],
            ['CC', 'Client Company Management'],
            ['I', 'Item Management'],
            ['CQ', 'Customer Quotation'],
            ['RQ', 'Requisition'],
            ['PO', 'Purchase Order'],
            ['QA', 'Purchase Quality Assurance'],
            ['SI', 'Sales Invoice'],
        ];

        foreach($moduleDataList as $moduleData) {
            $module = new Module(
                new ModuleCode($moduleData[0]), 
                $moduleData[1]
            );
            EntityManager::persist($module);
            //  TODO: if modules grow, use a buffer:
            //  https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/batch-processing.html#bulk-inserts
        }
        EntityManager::flush();
        EntityManager::clear();
    }
}
