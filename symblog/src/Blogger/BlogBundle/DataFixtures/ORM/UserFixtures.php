<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/UserFixtures.php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        $user1 = new User();
        $user1->setUsername('yfw1');
        $user1->setPassword(hash('sha1','3887280'));

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('yla228');
        $user2->setPassword(hash('sha1','8173922'));

        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('yhw3');
        $user3->setPassword(hash('sha1','9920415'));

        $manager->persist($user3);

        $user3 = new User();
        $user3->setUsername('wangsuiw');
        $user3->setPassword(hash('sha1','7231761'));

        $manager->persist($user1);

      
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
?>
