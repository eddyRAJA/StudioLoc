<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Studio;
use App\Entity\CategoryStudio;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class StudioFixtures extends Fixture
{
       public const STUDIOS = [
        'Recording',
        'Mixing',
        'Mastering',
        'Video'
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        foreach (self::STUDIOS as $key => $categoryName) {
            $category = new CategoryStudio();
            $category->setName($categoryName);

            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
            //dd('category_' . $key);          
        }
        $manager->flush();

        
// Attempted to call an undefined method named "setCategory" of class "Doctrine\Common\Collections\ArrayCollection".

 /*         for ($i=0; $i < 11 ; $i++) { 
            $studio = new Studio();
            $studio->getName($faker->sentence(2))
                ->setCategory($this->getReference('category_'. $faker->numberBetween(9,12)))
                ->setSummary($faker->paragraph(5))
                ->setPoster('/assets/images/studioLoc.jpg')
                ->setUnitPrice($faker->numberBetween(40, 60))
                ->setDetail($faker->paragraph(10));

                $manager->persist($studio);
            
        };

        $manager->flush();*/
    }
}
