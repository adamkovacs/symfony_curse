<?php

namespace Blog\CoreBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('app', array($this, 'appFilter')),
        );
    }

    public function appFilter($value)
    {
        return '*'.$value.'*';
    }

    public function getName()
    {
        return 'app_extension';
    }
}