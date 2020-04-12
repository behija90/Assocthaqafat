<?php

namespace App\Controller\FrontOffice;
use App\Entity\Affiliation;
use App\Form\AffiliationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AffiliationController extends AbstractController
{

    /**
     * @Route("/affiliation", name="front_affiliation")
     */
    public function inscription(Request $request)
    {
        $affiliation = new Affiliation();
        $form = $this->createForm(AffiliationType::class, $affiliation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $affiliation->setDateCreation(new \dateTime());
            $em->persist($affiliation);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('front_affiliation');
        }
        return $this->render('frontOffice/affiliation/index.html.twig', array(
            'form'=> $form->createView(),
        ));
    }

}