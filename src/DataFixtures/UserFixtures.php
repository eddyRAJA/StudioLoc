<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    //private $encoder;
    private $passwordHasher;

    //public function __construct(UserPasswordEncoderInterface $encoder)
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        //$this->encoder = $encoder;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “contributeur” (= auteur)
        $contributor = new User();
        $contributor->setFirstname('Contry')
            ->setLastname('Butor')
            ->setPhone('01 02 03 04 05')
            ->setAdress('2 rue de la Rue')
            ->setEmail('user1@monsite.com')
            ->setRoles(['ROLE_USER'])
            //$contributor->setPassword($this->encoder->encodePassword(
            ->setPassword($this->passwordHasher->hashPassword(
                $contributor,
                'user1pass'
            ));

        $manager->persist($contributor);
        //$this->addReference('owner_' . 1, $contributor);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setFirstname('Ad')
            ->setLastname('Mino')
            ->setPhone('06 02 08 04 05')
            ->setAdress('222 Av Avenue')
            ->setEmail('admino@monsite.com')
            ->setRoles(['ROLE_ADMIN'])
            //$admin->setPassword($this->encoder->encodePassword(
            ->setPassword($this->passwordHasher->hashPassword(
                $admin,
                'admipass'
            ));

        $manager->persist($admin);
        //$this->addReference('owner_' . 2, $admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }
}
