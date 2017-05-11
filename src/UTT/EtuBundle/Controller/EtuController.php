<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 09/05/2017
 * Time: 13:25
 */

namespace UTT\EtuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\EtuBundle\Entity\Etudiant;
use UTT\EtuBundle\Form\EtudiantType;

class EtuController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTEtuBundle:Etu:index.html.twig');
    }
    public function addAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantType::class, $etudiant);


        return $this->render('UTTEtuBundle:Etu:add.html.twig',array(
            'form' => $form->createView(),
        ));
    }
}