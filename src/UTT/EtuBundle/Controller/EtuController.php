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
        $repositoryEtudiant = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Etudiant')
        ;
        $etudiants=$repositoryEtudiant->findBy([],array('nom'=>'ASC'),5,0);
        return $this->render('UTTEtuBundle:Etu:index.html.twig',array('etudiants'=>$etudiants));
    }
    public function addAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form   = $this->get('form.factory')->create(EtudiantType::class, $etudiant);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('utt_etu_view', array('idetu' => $etudiant->getIdEtudiant()));
        }



        return $this->render('UTTEtuBundle:Etu:add.html.twig',array(
            'form' => $form->createView()
        ));
    }
}