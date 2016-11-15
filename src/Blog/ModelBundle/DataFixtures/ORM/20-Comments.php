<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post Entity
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

        $comments = array(
            0 => "Vivamus vel lorem a arcu vestibulum pretium. Proin facilisis luctus ante sed mollis.
            Curabitur eget rutrum erat. Aenean ex ipsum, ultrices vestibulum tempus in, facilisis in mauris.
            Mauris lorem enim, imperdiet nec dignissim vitae, varius sed justo. Proin mollis lobortis gravida.",
            1 => "Ut bibendum, risus ac consequat egestas, libero purus vehicula ante, ac molestie quam lacus
            tristique felis. Nullam bibendum, ipsum eget vulputate pharetra, est sem mollis dolor, non tempor
            eros lacus eget sapien. Praesent dictum quis justo non feugiat.",
            2 => "Nulla vel porta nisi. Cras posuere nisi sit amet risus dignissim, quis feugiat ipsum vestibulum.
            Aenean tempor, erat et fringilla varius, massa leo commodo nunc, vitae malesuada arcu purus ut enim.
            Nullam convallis sapien quis feugiat lacinia."
        );

        $i = 0;

        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('Someone');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}