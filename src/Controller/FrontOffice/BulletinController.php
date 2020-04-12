<?php

namespace App\Controller\FrontOffice;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Affiliation;
use App\Entity\Bulletin;
use App\Form\AffiliationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BulletinController extends AbstractController
{
    /**
     * @Route("/bulletins", name="front_bulletins_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository(Bulletin::class)->findBy(array(), array('id'=>'desc'));

        $bulletins = $paginator->paginate($query, $request->query->get('page', 1), 12);

        return $this->render('frontOffice/default/bulletin.html.twig', array(
            'bulletins'=> $bulletins
        ));
    }

    /**
     * @Route("/affiliation", name="Affiliation_ajouter")
     */
    public function ajouter(Request $request)
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
            return $this->redirectToRoute('Affiliation_ajouter');
        }
        return $this->render('frontOffice/Affiliation/index.html.twig', array(
            'form'=> $form->createView(),
        ));
    }


}