<?php

namespace App\Controller\BackOffice;

use App\Entity\Activite;
use App\Form\ActiviteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller
 */
class ActiviteController extends AbstractController
{
    /**
     * @Route("activites/", name="activites_liste")
     */
    public function liste(Request $request)
    {
        $activites = $this->getDoctrine()->getRepository(Activite::class)->findBy(array(), array('id' => 'desc'));

        return $this->render('backOffice/activites/index.html.twig', array(
            'activite' => $activites,
        ));
    }

    /**
     * @Route("/admin/activites/voir/{id}/{lang}", name="activite_voir")
     */
    public function voir($id, $lang)
    {
        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository('App:Activite')->find($id);
        if ($lang == 'en') {
            return $this->render('backOffice/activites/voir_activite_english.html.twig', array(
                'activite' => $activite
            ));
        }
        return $this->render('backOffice/activites/voir_activite_arabe.html.twig', array(
            'activite' => $activite
        ));
    }

    /**
     * @Route("/admin/activite/ajouter", name="activite_ajouter")
     */
    public function ajouter(Request $request)
    {
        $activite = new Activite();
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $activite->setDate(new \dateTime());
            $em->persist($activite);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('activites_liste');
        }
        return $this->render('backOffice/activites/ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/activite/modifier/{id}", name="activite_modifier")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $activite = $em->getRepository('App:Activite')->find($id);

        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('activites_liste');
        }
        return $this->render('backOffice/activites/modifier.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/admin/activite/supprimer/{id}", name="activite_supprimer")
     */
    public function supprimer(Activite $activite)
    {
        if ($activite) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activite);
            $em->flush();
            $this->addFlash('msgSuccess', 'Suppression avec succès');
        }
        return $this->redirectToRoute('activites_liste');

    }


    /**
     * @Route("/admin/activite/publier/{id}", name="activite_publier")
     */
    public function publier(Activite $activite)
    {
        if ($activite) {
            if ($activite->getPublier() == true) {
                $activite->setPublier(false);
                $this->addFlash('msgSuccess', 'activite est désactivé');
            } else {
                $activite->setPublier(true);
                $this->addFlash('msgSuccess', 'activite est publié');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        return $this->redirectToRoute('activites_liste');

    }
}
