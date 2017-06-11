<?php

namespace UTT\CursusBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CursusBundle\Entity\Cursus;
use UTT\CursusBundle\Form\CursusType;

class CursusController extends Controller
{
    public function addAction(Request $request)
    {
        $cursus = new Cursus();
        $form   = $this->get('form.factory')->create(CursusType::class, $cursus);

        $idEtudiant="";
        if ($request->isMethod('POST'))
        {
            $idEtudiant=$_POST['idEtudiant'];
        }

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $idetu=$_POST["idetu"];
            $repositoryEtudiant = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('UTTEtuBundle:Etudiant')
            ;
            $etudiant=$repositoryEtudiant->find($idetu);
            $label=$etudiant->getPrenom().$etudiant->getNom()."-".$etudiant->getIdEtudiant()." : ".(count($etudiant->getCursus())+1);
            $cursus->setLabel($label);
            $cursus->setEtudiant($etudiant);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('utt_etu_view', array('id' => $cursus->getId()));
        }




        return $this->render('UTTCursusBundle:Cursus:add.html.twig',array(
            'form' => $form->createView(),"idEtudiant"=>$idEtudiant
        ));
    }
}
?>