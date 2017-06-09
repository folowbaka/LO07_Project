<?php

namespace UTT\CSVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CSVBundle\Entity\CSV;
use UTT\CSVBundle\Form\CSVType;
use UTT\EtuBundle\Entity\Etudiant;
use UTT\EtuBundle\Entity\Admission;
use UTT\EtuBundle\Entity\Filliere;

class CSVController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('UTTCSVBundle:CSV:index.html.twig');
    }
    public function uploadAction(Request $request)
    {
        $repositoryEtudiant = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Etudiant');
        $repositoryAdmission = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Admission');
        $repositoryFilliere = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Filliere');
        $em = $this->getDoctrine()->getManager();
        $csv= new CSV();
        $form   = $this->get('form.factory')->create(CSVType::class, $csv);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {            
            $data=$form['file']->getData();
            $donnee= null;
            $file=  fopen($data->getrealpath(), "r");
            while (($donnee_ligne = fgetcsv($file, 1000, ";")) !== FALSE)
                    {
                        $donnee[] = $donnee_ligne;
                     } 
            fclose($file);                    
            
            
            if($donnee[0][0]=="ID")
            {
                $idetu=$donnee[0][1];
                 $etudiant=$repositoryEtudiant->find($idetu);

                 if($etudiant==null)
                 {
                     $etudiantobjet=new Etudiant();
                     $etudiant=array();
                     for ($i=0;$i<=4;$i++)
                     {
                         array_push($etudiant,$donnee[$i][1]);
                     }
                    dump($etudiant);
                    $etudiantobjet=new Etudiant();
                    dump(gettype($etudiantobjet));
                    $admission=new Admission();
                    $admission=$repositoryAdmission->findOneByNom($etudiant[3]);
                    dump(gettype($admission));
                    $filliere=$repositoryFilliere->findOneByNom($etudiant[4]);
                    $etudiantobjet->setIdEtudiant($etudiant[0]);
                    $etudiantobjet->setNom($etudiant[1]);
                    $etudiantobjet->setPrenom($etudiant[2]);
                    $etudiantobjet->setAdmission($admission);
                    $etudiantobjet->setFilliere($filliere);
                    dump($etudiant);
                    $em->persist($etudiantobjet);
                    $em->flush();
                 }
                 else
                     {
                     
                     }
                     
                 }
            }
                           
            $em->persist($csv);
            $em->flush();
            

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            //return $this->redirectToRoute('utt_csv_view',array('idcsv'=>$csv->getId()));
        
        



        return $this->render('UTTCSVBundle:CSV:upload.html.twig',array('form' => $form->createView()
        ));           
        }
}
