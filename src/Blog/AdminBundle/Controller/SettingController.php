<?php
namespace Blog\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class SettingController
 * @Route("setting")
 */
class SettingController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('ModelBundle:Setting')->findAll();
        return $this->render('AdminBundle:Setting:index.html.twig',
            array(
                $settings[0]->getKey() => $settings[0]->getValue()
            )
            );
    }
    /**
     * @param Request $request
     *
     * @Route("/edit")
     * @Method("POST")
     * @return RedirectResponse
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $settings = $request->get('settings', array());
        foreach ($settings as $key => $value) {
            $setting = $em->getRepository('ModelBundle:Setting')->findBy(
                array(
                    'key' => $key
                )
            );
            foreach($setting as $row) {
                $row->setValue($value);
                $em->persist($row);
            }
        }
        $em->flush();
        return $this->redirect(
            $this->generateUrl('blog_admin_setting_index')
        );
    }
}