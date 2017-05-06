<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Etudiant;
use AppBundle\Form\EtudiantType;




class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/AjoutEtudiant", name="AjouterEtudiant")
     */
    public function  ajouterFormulaireAction(Request $request){
        $etudiant= new Etudiant();
    //on récupère le formulaire et ce formulaire doit être crée à partir de $etudiant
        $form=$this->createform(EtudiantType::class,$etudiant);

        //on va passer la requête qu'on le recupère avec le paramètre
        $form->handleRequest($request);

        //si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){
            //on enregistre le produit dans bdd : entity manager permet de gérer l'entité etudiant
            $em=$this->getDoctrine()->getManager();
            //on prépare mon objet pour insérer dans la bdd
            $em->persist($etudiant);
            //évacuer les données dans la bdd
            $em->flush();
            return new RedirectResponse($this->generateUrl('AjouterEtudiant'));

        }

        //on génère le html du formulaire
        $formView=$form->createView();

        //on rend la vue
        return $this->render('AppBundle:Etudiant:ajouterEtudiant.html.twig', array('form'=>$formView));
    }
}
