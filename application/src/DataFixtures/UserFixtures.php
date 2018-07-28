<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 2000; $i++) {
            $user = new User();
            $user->setName('name-' . $i);
            $user->setLogin('login-' . $i);
            $user->setEmail('email-' . $i . '@ubuntu');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
