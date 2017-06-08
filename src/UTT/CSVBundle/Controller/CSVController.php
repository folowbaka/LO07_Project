<?php

namespace UTT\CSVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CSVBundle\Entity\CSV;
use UTT\CSVBundle\Form\CSVType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class CSVController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('UTTCSVBundle:CSV:index.html.twig');
    }
    public function uploadAction(Request $request)
    {
        $csv= new CSV();
        $form   = $this->get('form.factory')->create(CSVType::class, $csv);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data=$form['file']->getData();
            $array= null;
            $file=  fopen($data->getrealpath(), "r");
            while (($donnee = fgetcsv($file, 1000, ";")) !== FALSE) {
                 $array[] = $donnee;
                     }
            dump($array[]);
            fclose($file);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($csv);
            $em->flush();
            

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            //return $this->redirectToRoute('utt_csv_view',array('idcsv'=>$csv->getId()));
        }
        



        return $this->render('UTTCSVBundle:CSV:upload.html.twig',array('form' => $form->createView()
        ));           
    }
}
