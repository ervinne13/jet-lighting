<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\System\Service\Builder\TrackingNumberBuilder;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\Service\TrackingNumberRepository;
use Jet\Domain\System\ValueObject\ModuleCode;

class ModuleTrackingNumbersSeeder extends Seeder
{
    /** @var ModuleRepository */
    private $moduleRepository;

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(ModuleRepository $moduleRepository, EntityManagerInterface $em) 
    {
        $this->moduleRepository = $moduleRepository;
        $this->em = $em;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleCodes = [
            'C', 'S', 'ISI', 'CQ', 'RQ','PO', 'SI'
        ];

        $builder = new TrackingNumberBuilder();

        foreach($moduleCodes as $code) {
            $tn = $builder->withCode($code)->build();            
            $tn->setModule($this->moduleRepository->findByCode(ModuleCode::fromString($code)));

            $this->em->persist($tn);
        }

        $this->em->flush();
    }
}
