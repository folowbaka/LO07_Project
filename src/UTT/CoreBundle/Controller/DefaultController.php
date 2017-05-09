<?php

namespace UTT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTCoreBundle:Default:index.html.twig');
    }
}
