<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\ValueObject\ModuleCode;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ModulesSeeder extends Seeder
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
            ['C', 'Client/Lead Management'],
            ['S', 'Supplier Management'],
            ['I', 'Item Management'],
            ['ISI', 'Item Stock Inquiry'],
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
            $this->em->persist($module);
            //  TODO: if modules grow, use a buffer:
            //  https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/batch-processing.html#bulk-inserts
        }
        $this->em->flush();
        $this->em->clear();
    }
}

