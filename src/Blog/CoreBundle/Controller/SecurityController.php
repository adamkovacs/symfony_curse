<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class SecurityController
 * @Route("/{_locale}", requirements={"_locale"="en|hu"}, defaults={"_locale"="en"})
 */
class SecurityController extends Controller
{
    /**
     * Login
     *
     * @return Response
     *
     * @Route("/login/")
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        //get the login error if is one
        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'CoreBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_email' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error
            )
        );
    }

    /**
     * Register
     *
     * @Route("/register/")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('Blog\ModelBundle\Form\UserType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('blog_core_security_login');
        }

        return $this->render(
            'CoreBundle:Security:register.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Login check
     *
     * @Route("/login_check/")
     */
    public function loginCheckAction()
    {
    }

    /**
     * Logout
     *
     * @Route("/logout/")
     */
    public function logoutAction()
    {
    }
}