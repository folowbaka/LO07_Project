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

        $textValidation=array();
        $validation=true;
        foreach ($regles as $regle)
        {
            $cibleAgregat=$regle->getCibleAgregat();
            $regleLabel=$regle->getLabel();
            if($regle->getAgregat()->getNom()=="EXIST")
            {
                $categorie=$repositoryCategorie->findOneBy(array("nom"=>$cibleAgregat));
                if($regle->getAffectation()->getNom()=="UTT")
                {

                    $elements = $repositoryElement->findOneby(array("categorie" => $categorie, "cursus" => $idCursus));
                    if(!empty($elements))
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez dans votre cursus un ".$cibleAgregat;
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." est n'est pas validée,vous n'avez pas validez dans votre cursus un ".$cibleAgregat;
                        $validation=false;
                    }
                }
                else
                {
                    $affectation=$regle->getAffectation();
                    $affectationNom=$affectation->getNom();
                    $elements=$repositoryElement->existElementCursus($idCursus,$categorie,$affectation);
                    if(!empty($elements))
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez un ".$cibleAgregat." en ".$affectationNom;
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." est n'est pas validée,vous n'avez pas validez de ".$cibleAgregat." en ".$affectationNom;
                        $validation=false;
                    }
                }

            }
            else if($regle->getAgregat()->getNom()=="SUM")
            {
                $seuil=$regle->getSeuil();
                if(empty($regle->getAffectation()))
                {
                    $sum=$repositoryElement->SumCreditCursus($idCursus);
                    if($sum>=$seuil)
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez plus de ".$seuil." crédits dans votre cursus  avec ".$sum.' crédits.';
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." n'est pas validée,vous avez validez que ".$sum." crédits dans votre cursus  alors qu'il faut valider plus de  ".$seuil.' crédits.';
                        $validation=false;
                    }
                }
                else if(preg_match("/^UTT\([A-Z-+]+\)/",$cibleAgregat))
                {
                    $utt=1;
                    $agregat=preg_split("/[+()]/",$cibleAgregat);
                    $affectation=$regle->getAffectation();
                    $affectationNom=$affectation->getNom();
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$agregat[1]));
                    $sum=0;
                    $sum=$sum+$repositoryElement->SumElementCursus($idCursus,$categorie,$affectation,$utt);
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$agregat[2]));
                    $sum=$sum+$repositoryElement->SumElementCursus($idCursus,$categorie,$affectation,$utt);
                    if($sum>=$seuil)
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez plus de ".$seuil." crédits ".$cibleAgregat." dans en ".$affectationNom."  avec ".$sum.' crédits.';
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." n'est pas validée,vous avez validez que ".$sum." crédits ".$cibleAgregat."en ".$affectationNom."  alors qu'il faut valider plus de  ".$seuil.' crédits.';
                        $validation=false;
                    }
                }
                else if (preg_match("/[a-zA-Z]\+[a-zA-Z]/",$cibleAgregat))
                {
                    $utt=null;
                    $cibleAgregats=explode("+",$cibleAgregat);
                    $affectation=$regle->getAffectation();
                    $affectationNom=$affectation->getNom();
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$cibleAgregats[0]));
                    $sum=0;
                    $sum=$sum+$repositoryElement->SumElementCursus($idCursus,$categorie,$affectation,$utt);
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$cibleAgregats[1]));
                    $sum=$sum+$repositoryElement->SumElementCursus($idCursus,$categorie,$affectation,$utt);
                    if($sum>=$seuil)
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez plus de ".$seuil." crédits ".$cibleAgregat." en ".$affectationNom."  avec ".$sum.' crédits.';
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." n'est pas validée,vous avez validez que ".$sum." crédits ".$cibleAgregat." en ".$affectationNom."  alors qu'il faut valider plus de  ".$seuil.' crédits.';
                        $validation=false;
                    }
                }
                else
                {
                    $utt=null;
                    $affectation=$regle->getAffectation();
                    $affectationNom=$affectation->getNom();
                    $categorie=$repositoryCategorie->findOneBy(array("nom"=>$cibleAgregat));
                    $sum=$repositoryElement->SumElementCursus($idCursus,$categorie,$affectation,$utt);
                    if($sum>=$seuil)
                    {
                        $textValidation[]="Regle ".$regleLabel." est validée,vous avez validez plus de ".$seuil." crédits ".$cibleAgregat." dans en ".$affectationNom."  avec ".$sum.' crédits.';
                    }
                    else
                    {
                        $textValidation[]="Regle ".$regleLabel." n'est pas validée,vous avez validez que ".$sum." crédits ".$cibleAgregat." en ".$affectationNom."  alors qu'il faut valider plus de  ".$seuil.' crédits.';
                        $validation=false;
                    }
                }
            }

        }
        $response = new JsonResponse(array("text"=>$textValidation,"validation"=>$validation));


        return $response;
    }


}
?>