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
use UTT\ReglementBundle\Entity\Agregat;
use UTT\ReglementBundle\Entity\Regle;
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
            $repositoryAgregat = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('UTTReglementBundle:Agregat');
            $repositoryAffectation = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('UTTCursusBundle:Affectation');
            $em = $this->getDoctrine()->getManager();
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

                $i=1;
                while(isset($donnee[$i+1]))
                {
                    $regle=new Regle();
                    $regle->setLabel($donnee[$i][0]);

                    $regle->setAgregat($repositoryAgregat->findOneBy(array("nom"=>$donnee[$i][1])));
                    $regle->setCibleAgregat($donnee[$i][2]);
                    $regle->setAffectation($repositoryAffectation->findOneBy(array("nom"=>$donnee[$i][3])));
                    $regle->setSeuil($donnee[$i][4]);
                    $reglement->addRegle($regle);
                    $i++;

                }
                $regle=new Regle();
                $regle->setLabel($donnee[$i][0]);
                $regle->setAgregat($repositoryAgregat->findOneBy(array("nom"=>$donnee[$i][1])));
                if($donnee[$i][4]!=null)
                    $regle->setSeuil($donnee[$i][4]);
                else
                    $regle->setSeuil($donnee[$i][3]);
                $reglement->addRegle($regle);

                $em->persist($reglement);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->render('UTTReglementBundle:Reglement:index.html.twig');
            }
            return $this->render('UTTReglementBundle:Reglement:index.html.twig');
        }
        return $this->render('UTTReglementBundle:Reglement:index.html.twig');
    }
}