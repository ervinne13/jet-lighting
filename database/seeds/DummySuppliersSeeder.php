<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\Common\Service\Builder\CompanyBasedEntityBuilder;

class DummySuppliersSeeder extends Seeder
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
        for ($i = 1; $i < 5; $i ++) {
            $builder = new CompanyBasedEntityBuilder();
            $builder
                ->withName("Dummy Supplier {$i}")
                ->withAddress("Dummy Supplier {$i} Address")
                ->withContactPerson("Juan Dela Cruz")
                ->withContactNumber("09123456789")
                ->withEmailAddress("dummy@supplier{$i}.com");
    
            $supplier = $builder->buildSupplier();
            $supplier->commitAndPersist($this->em);
        }
      
        $this->em->flush();
    }
}
