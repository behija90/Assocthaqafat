<?php

namespace App\Controller\BackOffice;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/admin/news/", name="news_liste")
     */
    public function liste(Request $request)
    {
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();

        return $this->render('backOffice/news/index.html.twig', array(
            'news' => $news,
        ));
    }

    /**
     * @Route("/admin/news/voir/{id}/{lang}", name="news_voir")
     */
    public function voir($id, $lang)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('App:News')->find($id);
        if ($lang == 'en') {
            return $this->render('backOffice/news/voir_news_english.html.twig', array(
                'news' => $news
            ));
        }
        return $this->render('backOffice/news/voir_news_arabe.html.twig', array(
            'news' => $news
        ));
    }

    /**
     * @Route("/admin/news/ajouter", name="news_ajouter")
     */
    public function ajouter(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $news->setDateNew(new \dateTime());
            $em->persist($news);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('news_ajouter');
        }
        return $this->render('backOffice/news/ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/news/modifier/{id}", name="news_modifier")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $News = $em->getRepository('App:News')->find($id);

        $form = $this->createForm(NewsType::class, $News);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('news_liste');
        }
        return $this->render('backOffice/news/modifier.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/admin/news/supprimer/{id}", name="news_supprimer")
     */
    public function supprimer(News $news)
    {
        if ($news) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();
            $this->addFlash('msgSuccess', 'Suppression avec succès');
        }
        return $this->redirectToRoute('news_liste');

    }

    /**
     * @Route("/admin/news/chercher", name="News_chercher")
     */
    public function chercher()
    {
        return $this->render('backOffice/news/index.html.twig', array());
    }

    /**
     * @Route("/admin/news/publier/{id}", name="news_publier")
     */
    public function publier(News $news)
    {
        if ($news) {
            if($news->getPublier() == true){
                $news->setPublier(false);
                $this->addFlash('msgSuccess', 'News est désactivé');
            }
            else{
                $news->setPublier(true);
                $this->addFlash('msgSuccess', 'News est publié');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        return $this->redirectToRoute('news_liste');

    }
}
