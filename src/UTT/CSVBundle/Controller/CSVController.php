<?php

namespace UTT\CSVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CSVBundle\Entity\CSV;
use UTT\CSVBundle\Form\CSVType;
use UTT\EtuBundle\Entity\Etudiant;
use UTT\CursusBundle\Entity\Element;
use UTT\CursusBundle\Entity\Cursus;
use Symfony\Component\HttpFoundation\StreamedResponse;



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
        $repositoryAffectation = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Affectation');
        $repositoryResultat = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Resultat');
        $repositorySemLabel = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:SemLabel');
        $repositoryCategorie = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Categorie');
        
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST'))
        {
            $donnee= null;
            $file= fopen($_FILES['file']['tmp_name'], "r");
            while (($donnee_ligne = fgetcsv($file, 1000, ";")) !== FALSE)
                    {
                        $donnee[] = $donnee_ligne;
                     } 
            fclose($file);                    
            
            
            if($donnee[0][0]=="ID")
            {
                $idetu=$donnee[0][1];
                 $etudiantobjet=$repositoryEtudiant->find($idetu);

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
                 $bite=array();
                 $kaka=array();
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
            
        }
        }


        public function generateAction(Request $req,$id){
            $response = new StreamedResponse();
            $response->setCallback(function() use ($id) {

            $repositoryElement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTCursusBundle:Element');
            $repositoryEtudiant = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UTTEtuBundle:Etudiant');
            $repositoryCursus =
                $this->getDoctrine()
                    ->getManager()
                    ->getRepository('UTTCursusBundle:Cursus');
            $cursus=$repositoryCursus->find($id);


            $elements=$repositoryElement->findByCursus($cursus);
            $etudiantobjet=$repositoryEtudiant->findOneByIdEtudiant($cursus->getEtudiant()->getIdEtudiant());
            $etudiant=array();
            $row=array('ID','NO','PR','AD','FI');
            array_push($etudiant,$etudiantobjet->getIdEtudiant());
            array_push($etudiant,$etudiantobjet->getNom());
            array_push($etudiant,$etudiantobjet->getPrenom());
            array_push($etudiant,$etudiantobjet->getAdmission()->getNom());
            array_push($etudiant,$etudiantobjet->getFilliere()->getNom());
            $data=array();

            foreach($elements as $element){
                $data_ligne=array();
                array_push($data_ligne,'EL');
                array_push($data_ligne,$element->getSemSeq());
                array_push($data_ligne,$element->getSemLabel()->getNom());
                array_push($data_ligne,$element->getSigle());
                array_push($data_ligne,$element->getCategorie()->getNom());
                array_push($data_ligne,$element->getAffectation()->getNom());
                if($element->getUtt())
                {
                    array_push($data_ligne,'Y');
                }
                else
                {
                    array_push($data_ligne,'N');

                }
                if($element->getProfil())
                {
                    array_push($data_ligne,'Y');
                }
                else
                {
                    array_push($data_ligne,'N');

                }
                array_push($data_ligne,$element->getCredit());
                array_push($data_ligne,$element->getResultat()->getNom());
                array_push($data, $data_ligne);


            }
            array_push($data,array('END','','','','','','','','',''));

            $handle = fopen('php://output', 'w+');
            for($i=0;$i<=4;$i++)
            {
                fputcsv($handle,array($row[$i],$etudiant[$i],'','','','','','','',''),';');
            }

            // Add the header of the CSV file
            fputcsv($handle, array('==', 's_seq', 's_label','sigle','categorie','affectation','utt','profil','credit','resultat'),';');
           foreach($data as $ligne) {
                fputcsv(
                    $handle, // The file pointer
                    $ligne, // The fields
                    ';' // The delimiter
                );
            }
            fclose($handle);
              });
            $response->setStatusCode(200);

            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition','attachment; filename="export.csv"');

            return $response;
             }
            
        }
            
        
        
        

