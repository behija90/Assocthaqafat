<?php

namespace App\Controller\FrontOffice;

use App\Entity\News;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="front_news_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository(News::class)->findBy(array(), array('id'=>'desc'));

        $newss = $paginator->paginate($query, $request->query->get('page', 1), 12);

        return $this->render('frontOffice/news/index.html.twig', array(
            'newss'=> $newss
        ));
    }

    /**
     * @Route("/news/voir/{slug}", name="front_news_voir")
     */
    public function voir($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository(News::class)->findOneBySlugAr($slug);

        $derniersNews = $em->getRepository(News::class)->findBy(array(), array('id'=>'desc'), 6,0);

        return $this->render('frontOffice/news/voir.html.twig', array(
            'news' => $news,
            'derniersNews'=> $derniersNews
        ));
    }

}