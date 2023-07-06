<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

 class AppFixtures extends Fixture
 {
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

     public function load(ObjectManager $manager): void
     {

        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('vincent.parrot@gmail.com');
        $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('vincentParrot99'));
        $admin->setFirstname('Vincent');
        $admin->setLastname('Parrot');
        $manager->persist($admin);

         $manager->flush();
     }
 }
