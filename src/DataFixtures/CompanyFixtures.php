<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $company = new Company();
        $company->setName('Nom De La Socité')
            ->setPoster('/assets/images/studioLoc.jpg')
            ->setDescription('Description here!');

        $manager->persist($company);

        $manager->flush();
    }
}
