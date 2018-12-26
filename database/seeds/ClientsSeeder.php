<?php

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Database\Seeder;
use Jet\Domain\Common\Service\Builder\CompanyBasedEntityBuilder;

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
        $builder = new CompanyBasedEntityBuilder();
        $builder
            ->withName('CRC REALTY DEVELOPMENT CORPORATION')
            ->withAddress('31 National Highway, San Pedro City, Laguna')
            ->withContactPerson('Juan Dela Cruz')
            ->withContactNumber('09123456789')
            ->withEmailAddress('contact@crc-dev.com');

        $client = $builder->buildClientCompany();
        $client->commitAndPersist($this->em);
        $this->em->flush();
    }
}
