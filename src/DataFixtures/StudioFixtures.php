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
    }
}
