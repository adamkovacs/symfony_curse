<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TagControllerTest
 */
class TagControllerTest extends WebTestCase
{
    /**
     * Test show tag
     */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Tag $tag */
        $tag = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Tag')->findFirst();
        $tagPostsCount = $tag->getPosts()->count();

        $crawler = $client->request('GET', '/tag/'.$tag->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful.');

        $this->assertCount($tagPostsCount, $crawler->filter('h2'), 'There should be '.$tagPostsCount.' posts.');
    }
}

