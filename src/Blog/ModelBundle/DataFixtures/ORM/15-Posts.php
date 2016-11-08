<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post Entity
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Lorem ipsum dolor sit amet');
        $p1->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Sed a luctus dolor, quis pretium est. Nullam pretium lectus ligula, et
          ultricies nunc placerat ac. Nunc nec dapibus ante, eu tincidunt elit.
           Maecenas ut pharetra ante. Donec venenatis tristique aliquet. Nam nec
            nunc quis nisi lobortis sagittis. Proin sit amet efficitur neque, a
             convallis eros. Etiam tellus ex, mattis id velit iaculis, sodales
              dictum mi. Suspendisse dignissim dignissim mauris id ultricies.
               Aenean sed pulvinar nisi. Integer commodo ornare odio at eleifend.
               Sed mattis neque hendrerit, consectetur eros non, placerat lorem.
               Praesent vel volutpat augue, a aliquet erat. Proin varius eu tellus at rutrum.');
        $p1->setAuthor($this->getAuthor($manager, 'David'));

        $p2 = new Post();
        $p2->setTitle('Nulla quis ultricies risus');
        $p2->setBody('Nulla quis ultricies risus, et vestibulum nunc. Quisque accumsan
         justo id nunc maximus, quis hendrerit lacus scelerisque. Etiam ullamcorper a turpis
          id ultrices. Cras quis tortor nec erat pharetra iaculis commodo cursus ante.
          Suspendisse potenti. Nunc eu nisi accumsan nisi egestas imperdiet. Suspendisse et dui
          facilisis, egestas velit condimentum, luctus lorem. Vestibulum viverra vel arcu ac pulvinar.
           Duis convallis consequat nisl quis venenatis. Maecenas mollis quam orci, at cursus justo
           ultricies sed. Nullam consequat fringilla felis eu vulputate. Phasellus eu sagittis libero,
            ut ullamcorper libero. Maecenas dignissim lobortis ipsum, sed mollis libero vulputate vitae.
            Vivamus nec posuere leo. Interdum et malesuada fames ac ante ipsum primis in faucibus.');
        $p2->setAuthor($this->getAuthor($manager, 'Eddie'));

        $p3 = new Post();
        $p3->setTitle('Ut porta at nibh a fermentum');
        $p3->setBody('Ut porta at nibh a fermentum. Vestibulum sed velit nisi. Phasellus sit amet sodales
         lectus. Ut ut pellentesque nunc. Pellentesque luctus augue vitae semper vulputate. Aliquam rhoncus
          vel est eu dignissim. Vivamus ac rutrum dui, cursus gravida elit. Vivamus rutrum ac justo quis
           euismod. Vestibulum sit amet sem quis risus laoreet cursus vel at urna. Etiam vitae hendrerit
            nulla, fermentum aliquet leo. Vivamus placerat laoreet tristique. Integer eleifend nisi in ex
             convallis, in tristique tellus ullamcorper.');
        $p3->setAuthor($this->getAuthor($manager, 'Eddie'));

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * Get an author
     *
     * @param ObjectManager $manager
     * @param string $name
     *
     * @return Author
     */
    private function getAuthor(ObjectManager $manager, $name)
    {
        return $manager->getRepository('ModelBundle:Author')->findOneBy(
          array(
              'name' => $name
          )
        );
    }
}