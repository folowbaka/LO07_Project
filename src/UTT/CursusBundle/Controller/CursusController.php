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
        if ($request->isMethod('POST') && isset($_POST['idEtudiant']))
        {
            $idEtudiant=$_POST['idEtudiant'];
        }

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $idEtudiant=$_POST["idetu"];
            $repositoryEtudiant = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('UTTEtuBundle:Etudiant')
            ;
            $etudiant=$repositoryEtudiant->find($idEtudiant);
            $label=$etudiant->getPrenom().$etudiant->getNom()."-".$etudiant->getIdEtudiant()." : ".(count($etudiant->getCursus())+1);
            $cursus->setLabel($label);
            $cursus->setEtudiant($etudiant);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('utt_etu_view', array('id' => $cursus->getEtudiant()->getIdEtudiant()));
        }




        return $this->render('UTTCursusBundle:Cursus:add.html.twig',array(
            'form' => $form->createView(),"idEtudiant"=>$idEtudiant
        ));
    }

    public function editAction(Request $request,$id)
    {
        $repositoryCursus = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Cursus');
        $cursus = $repositoryCursus->find($id);
        $form   = $this->get('form.factory')->create(CursusType::class, $cursus);
        if ($request->isMethod('POST') && isset($_POST['editCursus']))
            {

                return $this->render('UTTCursusBundle:Cursus:edit.html.twig',array(
                    'form' => $form->createView()));
            }
        if ($request->isMethod('POST') && isset($form) && $form->handleRequest($request)->isValid())
            {

                    $em = $this->getDoctrine()->getManager();
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                    $idEtu=$cursus->getEtudiant()->getIdEtudiant();
                    return $this->redirectToRoute('utt_etu_view', array('id' => $idEtu));
            }

        return $this->render('UTTCursusBundle:Cursus:edit.html.twig');

    }


}
?>