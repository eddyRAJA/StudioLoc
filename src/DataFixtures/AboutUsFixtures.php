<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\AboutUs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AboutUsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $subject = new AboutUs();
            $subject->setTitle($faker->sentence(3))
                ->setPoster('/assets/images/studioLoc.jpg')
                ->setDescription($faker->paragraph(5));

            $manager->persist($subject);
        }

        $manager->flush();
    }
}
