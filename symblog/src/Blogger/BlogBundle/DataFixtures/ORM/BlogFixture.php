<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/BlogFixtures.php


namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Blog;

class BlogFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $blog1 = new Blog();
        $blog1->setTitle('A day with Symfony2');
        $blog1->setBlog('This the a very busy day with Symfony2 and Doctrine.');
        $blog1->setImage('beach.jpg');
        $blog1->setAuthor('yfw1');
        $blog1->setTags('symfony2, symblog');
        $blog1->setCreated(new \DateTime());
        $blog1->setUpdated($blog1->getCreated());
        $manager->persist($blog1);

        $blog2 = new Blog();
        $blog2->setTitle('Data Fixtures is used when the registered entities has no entries.');
        $blog2->setBlog('Do you think this is regular blog entry? NOoooooooo, this is what fixtures show you. Try other entry');
        $blog2->setImage('misdirection.jpg');
        $blog2->setAuthor('yfw1');
        $blog2->setTags('doctrine, symblog');
        $blog2->setCreated(new \DateTime("2011-07-23 06:12:33"));
        $blog2->setUpdated($blog2->getCreated());
        $manager->persist($blog2);

        $blog3 = new Blog();
        $blog3->setTitle('Surprise? Fixtures blog again');
        $blog3->setBlog('LOL');
        $blog3->setImage('one_or_zero.jpg');
        $blog3->setAuthor('yfw1');
        $blog3->setTags('doctrine , symblog');
        $blog3->setCreated(new \DateTime("2011-07-16 16:14:06"));
        $blog3->setUpdated($blog3->getCreated());
        $manager->persist($blog3);

        $blog4 = new Blog();
        $blog4->setTitle('Fixture can help populate some entry into database');
        $blog4->setBlog('Fixture blog entry again.');
        $blog4->setImage('the_grid.jpg');
        $blog4->setAuthor('yfw1');
        $blog4->setTags('doctrine, symblog');
        $blog4->setCreated(new \DateTime("2012-10-14 16:54:12"));
        $blog4->setUpdated($blog4->getCreated());
        $manager->persist($blog4);

        $blog5 = new Blog();
        $blog5->setTitle('This is the last available fixture blog entry');
        $blog5->setBlog('Hey, I told you that all the previous blog entry are created by fixture. This is the last one. You should stop trying to retrieve even more entry.');
        $blog5->setImage('pool_leak.jpg');
        $blog5->setAuthor('yfw1');
        $blog5->setTags('doctrine, symblog');
        $blog5->setCreated(new \DateTime("2010-10-14 17:34:18"));
        $blog5->setUpdated($blog5->getCreated());
        $manager->persist($blog5);


        $manager->flush();

        $this->addReference('blog-1', $blog1);
        $this->addReference('blog-2', $blog2);
        $this->addReference('blog-3', $blog3);
        $this->addReference('blog-4', $blog4);
        $this->addReference('blog-5', $blog5);

    }

    public function getOrder()
    {
        return 1;
    }

}
?>
