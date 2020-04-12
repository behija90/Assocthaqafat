<?php

namespace App\Controller\BackOffice;

use App\Entity\Donnee;
use App\Form\DonneeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller
 */
class DonneeController extends AbstractController
{
    /**
     * @Route("/admin/donnee/", name="donnee_liste")
     */
    public function liste(Request $request)
    {
        $donnee = $this->getDoctrine()->getRepository(Donnee::class)->findAll();

        return $this->render('backOffice/Donnee/index.html.twig', array(
            'donnee' => $donnee,
        ));
    }

    /**
     * @Route("/admin/donnee/voir/{id}/{lang}", name="donnee_voir")
     */
    public function voir($id, $lang)
    {
        $em = $this->getDoctrine()->getManager();
        $donnee = $em->getRepository('App:Donnee')->find($id);
        if ($lang == 'en') {
            return $this->render('backOffice/donnee/voir_donnee_english.html.twig', array(
                'donnee' => $donnee
            ));
        }
        return $this->render('backOffice/donnee/voir_donnee_arabe.html.twig', array(
            'donnee' => $donnee
        ));
    }

    /**
     * @Route("/admin/donnee/ajouter", name="donnee_ajouter")
     */
    public function ajouter(Request $request)
    {
        $donnee = new Donnee();
        $form = $this->createForm(DonneeType::class, $donnee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $donnee->setDateNew(new \dateTime());
            $em->persist($donnee);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('donnee_ajouter');
        }
        return $this->render('backOffice/donnee/ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/donnee/modifier/{id}", name="donnee_modifier")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Donnee = $em->getRepository('App:Donnee')->find($id);

        $form = $this->createForm(DonneeType::class, $Donnee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('donnee_liste');
        }
        return $this->render('backOffice/donnee/modifier.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/admin/donnee/supprimer/{id}", name="donnee_supprimer")
     */
    public function supprimer(Donnee $donnee)
    {
        if ($donnee) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($donnee);
            $em->flush();
            $this->addFlash('msgSuccess', 'Suppression avec succès');
        }
        return $this->redirectToRoute('donnee_liste');

    }


    /**
     * @Route("/admin/donnee/publier/{id}", name="donnee_publier")
     */
    public function publier(Donnee $donnee)
    {
        if ($donnee) {
            if($donnee->getPublier() == true){
                $donnee->setPublier(false);
                $this->addFlash('msgSuccess', 'Donnee est désactivé');
            }
            else{
                $donnee->setPublier(true);
                $this->addFlash('msgSuccess', 'Donnee est publié');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        return $this->redirectToRoute('donnee_liste');

    }
}
