<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Studio;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\StudioFixtures;
use Faker;


class StudiooFixtures extends Fixture implements DependentFixtureInterface
{
    
    
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $seasons = [];
        
       
        for ($i=0; $i < count(StudioFixtures::STUDIOS); $i++) {
            for ($seasonNumber=0; $seasonNumber<rand(1, 3); $seasonNumber++)  {
                $studio = new Studio();
                $studio->setName($faker->sentence(2))
                    ->setCategory($this->getReference('category_' . $i));
            $manager->persist($studio);
               
            };
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            StudioFixtures::class,
        ];
    }
}