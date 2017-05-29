<?php

namespace UTT\CSVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UTT\CSVBundle\Entity\CSV;
use UTT\CSVBundle\Form\CSVType;

class CSVController extends Controller
{
    public function indexAction()
    {
        return $this->render('UTTCSVBundle:CSV:index.html.twig');
    }
    public function uploadAction(Request $request)
    {
        $csv = new CSV();
        $form   = $this->get('form.factory')->create(CSVType::class, $csv);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($csv);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('utt_csv_view',array('id' => $csv->getId()));
        }



        return $this->render('UTTCSVBundle:CSV:upload.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
