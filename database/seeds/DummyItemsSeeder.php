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
        $costs = [
            new SupplierCost($this->supplierRepo->find('S-00000002'), new Amount(350.00)),
            new SupplierCost($this->supplierRepo->find('S-00000004'), new Amount(349.00))
        ];
        
        $ledWrapAround = new Item(
            'JT24FT-LED-W-4K',
            "4' LED Wrap Around", 
            'Contemporary design, quick installation, Surface-mounted, impact resistant prismatic acrylic lens, ideal replacement for traditional 2-light integrated LED modules.',
            $costs
        );

        $this->em->persist($ledWrapAround);

        $ledSecurityLightBlack = new Item(
            "JT-2-Security-BR",
            "LED Security Light Black",
            "LED wall pack with high bright LED chip, energy saving and pro environment lighting stable and long lifespan. Optical-grade glass lampshade. High heat conduction aluminum alloy shell, vacuum dust-free spray, anti-corrorsion, no stripping. Strict waterproof treatment technology, meet international waterproof and dustproof standards. Can three-dimensional rotatem wide rotation angle, flexible and convenient adjustment. Radiate light protection design, won't affect the lighting effects because of weather."
        );

        $this->em->persist($ledSecurityLightBlack);

        $jml12V = new Item(
            "JML-303-12V",
            "JML-303-12V",
            "LED 1W X 3 150L 3000K Ideal in ceiling applications Perfect for use in kitchen and shelvings, cabinets, and displays Metal body May be mounted recessed Includes driver."
        );

        $this->em->persist($jml12V);

        $this->em->flush();
    }
}
