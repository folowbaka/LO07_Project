<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 13/06/2017
 * Time: 18:17
 */

namespace UTT\ReglementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\ReglementBundle\Entity\Reglement;

class ReglementController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTReglementBundle:Reglement:index.html.twig');
    }
    public function viewAction()
    {
        return $this->render('UTTReglementBundle:Reglement:view.html.twig');
    }
    public function importAction(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $reglement=new Reglement();
            $donnee = null;
            $file = fopen($_FILES['file']['tmp_name'], "r");
            while (($donnee_ligne = fgetcsv($file, 1000, ";")) !== FALSE) {
                $donnee[] = $donnee_ligne;
            }
            fclose($file);

            if($donnee[0][0]=="LABEL")
            {
                $reglement->setLabel($donnee[0][1]);

                if($etudiantobjet === null)
                {
                    $etudiant=array();
                    for ($i=0;$i<=4;$i++)
                    {
                        array_push($etudiant,$donnee[$i][1]);
                    }
                    $etudiantobjet=new Etudiant();
                    $admission=$repositoryAdmission->findOneByNom($etudiant[3]);
                    $filliere=$repositoryFilliere->findOneByNom($etudiant[4]);
                    $etudiantobjet->setIdEtudiant($etudiant[0]);
                    $etudiantobjet->setNom($etudiant[1]);
                    $etudiantobjet->setPrenom($etudiant[2]);
                    $etudiantobjet->setAdmission($admission);
                    $etudiantobjet->setFilliere($filliere);
                    $em->persist($etudiantobjet);
                    $em->flush();
                }

                $cursus=new Cursus();
                $i=6;
                while($donnee[$i][0]==="EL")
                {
                    $element=array();
                    for($k=1;$k<=9;$k++)
                    {
                        array_push($element,$donnee[$i][$k]);

                    }
                    $elementobjet=new Element();
                    $elementobjet->setSemSeq($element[0]);
                    $elementobjet->setCredit($element[7]);
                    $elementobjet->setSigle($element[2]);
                    $elementobjet->setAffectation($repositoryAffectation->findOneByNom($element[4]));
                    $elementobjet->setCategorie($repositoryCategorie->findOneByNom($element[3]));
                    $elementobjet->setSemLabel($repositorySemLabel->findOneByNom($element[1]));
                    $elementobjet->setResultat($repositoryResultat->findOneByNom($element[8]));
                    if($element[6]==='Y')
                    {
                        $elementobjet->setProfil('1');
                    }
                    else
                    {
                        $elementobjet->setProfil('0');
                    }
                    if($element[5]==='Y')
                    {
                        $elementobjet->setUtt('1');
                    }
                    else
                    {
                        $elementobjet->setUtt('0');
                    }
                    $cursus->addElement($elementobjet);
                    $i++;

                }
                $cursus->setEtudiant($etudiantobjet);
                $label=$etudiantobjet->getPrenom().$etudiantobjet->getNom()."-".$etudiantobjet->getIdEtudiant()." : ".(count($etudiantobjet->getCursus())+1);
                $cursus->setLabel($label);
                $em->persist($cursus);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('utt_etu_view',array('id'=>$etudiantobjet->getIdEtudiant()));
            }
            return $this->render('UTTReglementBundle:Reglement:view.html.twig',array('donnee'=>$data));
        }
        return $this->render('UTTReglementBundle:Reglement:view.html.twig',array('donnee'=>$donnee));
    }
}