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
        $etudiants=$repositoryEtudiant->findBy([],array('nom'=>'ASC'),15,0);
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
    public function viewAction($id,Request $request)
    {
        $repositoryEtudiant = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Etudiant')
        ;
        $etudiant=$repositoryEtudiant->find($id);
        if($request->isMethod('POST') && isset($_POST['deleteEtudiantBool']))
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etudiant);
            $em->flush();
            return $this->redirectToRoute('utt_etu_homepage');
        }
        $form   = $this->get('form.factory')->create(EtudiantType::class, $etudiant);
        $form->remove('idEtudiant');
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        $listeCursus=$etudiant->getCursus();
        $listeSemester=array();
        $repositoryElement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Element')
        ;
        foreach ($listeCursus as $cursus)
        {
            $listeSemester[] = $repositoryElement->findSemesterCursus($cursus->getId());
        }



        return $this->render('UTTEtuBundle:Etu:view.html.twig',array('form'=>$form->createView(),'listeCursus'=>$listeCursus,'listeSemester'=>$listeSemester,'idEtudiant'=>$etudiant->getIdEtudiant()));
    }
}