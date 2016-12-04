<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TagController
 *
 * @Route("/{_locale}", requirements={"_locale"="en|hu"}, defaults={"_locale"="en"})
 */
class TagController extends Controller
{
    /**
     * Show tags
     *
     * @return array
     *
     * @Route("/")
     * @Template("CoreBundle:Tag:index.html.twig")
     */
    public function indexAction()
    {
        $tags = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findUsageTags();

        return array(
            'tags' => $tags
        );
    }

    /**
     * Show posts by tag
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/tag/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $tag = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if (null === $tag) {
            throw $this->createNotFoundException('Tag was not found');
        }

        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findPostsByTag($tag);

        return array(
            'tag' => $tag,
            'posts' => $posts
        );
    }
}
