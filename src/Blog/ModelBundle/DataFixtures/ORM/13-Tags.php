<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Tag Entity
 */
class Tags extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 13;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $t1 = new Tag();
        $t1->setName('Tag1');

        $t2 = new Tag();
        $t2->setName('Tag2');

        $t3 = new Tag();
        $t3->setName('Tag3');

        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);

        $manager->flush();
    }
}
