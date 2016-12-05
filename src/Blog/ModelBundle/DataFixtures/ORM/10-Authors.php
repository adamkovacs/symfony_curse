<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Author Entity
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Author();
        $a1->setName('David');
        $a1->setPassword('david');
        $a1->setRoles('ROLE_SUPER_ADMIN');

        $a2 = new Author();
        $a2->setName('Eddie');
        $a2->setPassword('eddie');
        $a2->setRoles('ROLE_ADMIN');

        $a3 = new Author();
        $a3->setName('Elsa');
        $a3->setPassword('elsa');
        $a3->setRoles('ROLE_ADMIN');

        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);

        $manager->flush();
    }
}