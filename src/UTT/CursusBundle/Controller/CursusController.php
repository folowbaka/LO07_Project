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

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cursus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('utt_cursus_view', array('id' => $cursus->getId()));
        }




        return $this->render('UTTCursusBundle:Cursus:add.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
?>