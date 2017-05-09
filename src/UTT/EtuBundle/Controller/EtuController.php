<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 09/05/2017
 * Time: 13:25
 */

namespace UTT\EtuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EtuController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTEtuBundle:Etu:index.html.twig');
    }
    public function addAction()
    {
        return $this->render('UTTEtuBundle:Etu:add.html.twig');
    }
}