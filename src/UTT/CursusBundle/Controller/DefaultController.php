<?php

namespace UTT\CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTCursusBundle:Default:index.html.twig');
    }
}
