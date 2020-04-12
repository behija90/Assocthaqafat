<?php

namespace App\Controller\FrontOffice;

use App\Entity\Activite;
use App\Entity\Page;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActiviteController extends AbstractController
{
    /**
     * @Route("/activites", name="front_activites_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository(Activite::class)->findBy(array(), array('id'=>'desc'));

        $activites = $paginator->paginate($query, $request->query->get('page', 1), 12);

        return $this->render('frontOffice/activite/index.html.twig', array(
            'activites'=> $activites
        ));
    }

    /**
     * @Route("/activtes/{slug}", name="front_activites_voir")
     */
    public function voir($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $activite = $em->getRepository(Activite::class)->findOneBySlugAr($slug);
        return $this->render('frontOffice/activite/voir.html.twig', array(
            'activite' => $activite
        ));
    }

    /**
     * @Route("/qui-sommes-nous", name="front_apropos")
     */
    public function apropos()
    {
        return new Response('page apropos front');
    }


}