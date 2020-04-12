<?php

namespace App\Controller\BackOffice;

use App\Entity\Bulletin;
use App\Form\BulletinType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller
 */
class BulletinController extends AbstractController
{
    /**
     * @Route("/admin/bulletin/", name="bulletin_liste")
     */
    public function liste(Request $request)
    {
        $bulletins = $this->getDoctrine()->getRepository(Bulletin::class)->findAll();

        return $this->render('backOffice/Bulletin/index.html.twig', array(
            'bulletins' => $bulletins,
        ));
    }

    /**
     * @Route("/admin/bulletin/voir/{id}/{lang}", name="bulletin_voir")
     */
    public function voir($id, $lang)
    {
        $em = $this->getDoctrine()->getManager();
        $bulletin = $em->getRepository('App:Bulletin')->find($id);
        if ($lang == 'en') {
            return $this->render('backOffice/bulletin/description_english.html.twig', array(
                'bulletin' => $bulletin
            ));
        }
        return $this->render('backOffice/bulletin/description_arabe.html.twig', array(
            'bulletin' => $bulletin
        ));
    }

    /**
     * @Route("/admin/bulletin/ajouter", name="bulletin_ajouter")
     */
    public function ajouter(Request $request)
    {
        $bulletin = new Bulletin();
        $form = $this->createForm(BulletinType::class, $bulletin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $bulletin->setDateAt(new \dateTime());
            $em->persist($bulletin);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('bulletin_ajouter');
        }
        return $this->render('backOffice/Bulletin/ajouter.html.twig', array(
            'form'=> $form->createView(),
        ));
    }

    /**
     * @Route("/admin/bulletin/modifier/{id}", name="bulletin_modifier")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bulletin = $em->getRepository('App:Bulletin')->find($id);

        $form = $this->createForm(BulletinType::class, $bulletin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('bulletin_liste');
        }
        return $this->render('backOffice/Bulletin/modifier.html.twig', array(
            'form'=> $form->createView(),
        ));

    }

    /**
     * @Route("/admin/bulletin/supprimer/{id}", name="bulletin_supprimer")
     */
    public function supprimer(Bulletin $bulletin)
    {
        if ($bulletin) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bulletin);
            $em->flush();
            $this->addFlash('msgSuccess', 'Supression avec sucès');
        }
        return $this->redirectToRoute('bulletin_liste');

    }

    /**
     * @Route("/admin/bulletin/chercher", name="bulletin_chercher")
     */
    public function chercher()
    {
        return $this->render('backOffice/Bulletin/index.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/bullein/publier/{id}", name="bulletin_publier")
     */
    public function publier(Bulletin $bulletin)
    {
        if ($bulletin) {
            if($bulletin->getPublier() == true){
                $bulletin->setPublier(false);
                $this->addFlash('msgSuccess', 'bulletin est désactivé');
            }
            else{
                $bulletin->setPublier(true);
                $this->addFlash('msgSuccess', 'bulletin est publié');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        return $this->redirectToRoute('bulletin_liste');

    }


}
