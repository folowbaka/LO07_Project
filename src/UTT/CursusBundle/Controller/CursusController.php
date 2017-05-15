<?php

namespace UTT\CursusBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CursusController extends Controller
{
    public function addAction(Request $request)
    {




        return $this->render('UTTCursusBundle:Cursus:add.html.twig');
    }
}
?>