<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 2000; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setLogin($faker->userName);
            $user->setEmail($faker->email);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
