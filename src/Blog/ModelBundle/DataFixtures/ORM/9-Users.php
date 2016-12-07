<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Author Entity
 */
class Users extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 9;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $u1 = new User();
        $u1->setName('David');
        $u1->setPassword('david');
        $u1->setEmail('david@gmail.com');

        $u2 = new User();
        $u2->setName('Eddie');
        $u2->setPassword('eddie');
        $u2->setEmail('eddie@gmail.com');

        $manager->persist($u1);
        $manager->persist($u2);

        $manager->flush();
    }
}
