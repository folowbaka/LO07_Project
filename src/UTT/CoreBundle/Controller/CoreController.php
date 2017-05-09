<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 09/05/2017
 * Time: 14:01
 */

namespace UTT\CoreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTCoreBundle:Core:index.html.twig');
    }
}