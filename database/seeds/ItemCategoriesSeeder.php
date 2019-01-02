<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\PLD\Entity\ItemCategory;

class ItemCategoriesSeeder extends Seeder
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
        $categories = [
            'Louver Lighting',
            'Industrial Lighting',
            'Track Lights',
            'Wall Lighting',
            'LED Indoor Wall Lamps & Step Lights',
            'Outdoor Lighting',
            'Emergency Lights',
            'LED Strip Lights, Rope Lights, Tape Lights & Neon Flex',
            'LED Hibay & Flood Lights',
            'Drop Lights',
            'Solar Street Lights'
        ];

        foreach($categories as $categoryName) {
            $this->em->persist(new ItemCategory($categoryName));
        }

        $this->em->flush();
    }
}
