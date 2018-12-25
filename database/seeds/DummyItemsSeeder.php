<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\Common\ValueObject\Amount;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Entity\SupplierCost;
use Jet\Domain\PLD\Service\SupplierRepository;

class DummyItemsSeeder extends Seeder
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var SupplierRepository */
    private $supplierRepo;

    public function __construct(EntityManagerInterface $em, SupplierRepository $supplierRepo)
    {
        $this->em = $em;
        $this->supplierRepo = $supplierRepo;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trackingNumber = tracking_number_by_module('I');

        $costs = [
            new SupplierCost($this->supplierRepo->find('S-00000002'), new Amount(350.00)),
            new SupplierCost($this->supplierRepo->find('S-00000004'), new Amount(349.00))
        ];
        $item = new Item(
            "4' LED Wrap Around", 
            'Contemporary design, quick installation, Surface-mounted, impact resistant prismatic acrylic lens, ideal replacement for traditional 2-light integrated LED modules.',
            $costs
        );

        $item->setId($trackingNumber->commit());

        $this->em->persist($item);
        $this->em->flush();
    }
}
