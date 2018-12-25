<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\CRM\Service\Builder\ClientCompanyBuilder;

class ClientsSeeder extends Seeder
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
        $trackingNumber = tracking_number_by_module('CC');
        
        $builder = new ClientCompanyBuilder();
        $builder
            ->withName('CRC REALTY DEVELOPMENT CORPORATION')
            ->withAddress('31 National Highway, San Pedro City, Laguna')
            ->withContactPerson('Juan Dela Cruz')
            ->withContactNumber('09123456789')
            ->withEmailAddress('contact@crc-dev.com');

        $client = $builder->build();
        $client->setTrackingNumber($trackingNumber->commit());

        $this->em->persist($trackingNumber);
        $this->em->persist($client);
        $this->em->flush();
    }
}
