<?php

namespace UTT\CursusBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CursusBundle\Entity\Cursus;
use UTT\CursusBundle\Form\CursusType;

use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function testCursuReglementAction(Request $request)
    {
        $repositoryElement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Element');
        $repositoryReglement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTReglementBundle:Reglement');
        $repositoryCategorie = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Categorie');
        $labelReglement=$request->request->get('reglement');
        $idCursus=$request->request->get('idCursus');
        $reglement=$repositoryReglement->findOneBy(array("label"=>$labelReglement));
        $regles=$reglement->getRegles();

        $i=0;
        $j=0;
        $validation=true;
        $agregat=[];
        foreach ($regles as $regle)
        {
            $cibleAgregat=$regle->getCibleAgregat();
            if($regle->getAgregat()->getNom()=="EXIST")
            {
                if($regle->getAffectation()->getNom()=="UTT")
                {
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$cibleAgregat));
                    $element=$repositoryElement->findOneby(array("categorie"=>$categorie,"cursus"=>$idCursus));
                    if(!empty($element))
                        $i++;
                }
            }
            else if($regle->getAgregat()->getNom()=="SUM")
            {
                if(empty($regle->getAffectation()))
                {

                }
                else if(preg_match("/^UTT\([A-Z-+]+\)/",$cibleAgregat))
                {
                    $agregat[]=preg_split("/[+()]/",$cibleAgregat);
                    $i++;
                }
                else if (preg_match("/[a-zA-Z]\+[a-zA-Z]/",$cibleAgregat))
                {
                    $i++;
                }
                else
                {
                    $i++;
                }
            }

        }
        $response = new JsonResponse(array('data' => $i));


        return $response;
    }


}
?>