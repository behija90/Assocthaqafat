<?php

namespace App\Controller\BackOffice;

use App\Entity\Affiliation;
use App\Form\AffiliationType;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Controller
 * @package App\Controller
 */
class AffiliationController extends Controller
{
    /**
     * @Route("/affiliation", name="affiliation_liste")
     */
    public function liste(Request $request)
    {
        $affiliations = $this->getDoctrine()->getRepository(Affiliation::class)->findAll();

        return $this->render('backOffice/affiliation/index.html.twig', array(
            'affiliations' => $affiliations,
        ));
    }

    /**
     * @Route("/affiliation/pdf/{id}", name="back_affiliation_pdf")
     */
    public function pdf($id, Pdf $pdf)
    {
        $em = $this->getDoctrine()->getManager();
        $affiliation = $em->getRepository(Affiliation::class)->find($id);

        if (file_exists($this->getParameter('affiliations_pdf') . '/'. $affiliation->getId() . '.pdf')) {
            unlink($this->getParameter('affiliations_pdf') . '/'. $affiliation->getId() . '.pdf');
        }


        $this->get('knp_snappy.pdf')->generateFromHtml(
            $html = $this->renderView('backOffice/affiliation/pdf.html.twig', array(
                'affiliation' => $affiliation
            )),
            $this->getParameter('affiliations_pdf') . '/'. $affiliation->getId() . '.pdf'
        );

        return new BinaryFileResponse($this->getParameter('affiliations_pdf') . '/'. $affiliation->getId() . '.pdf');

        /*  return new PdfResponse(
              $pdf->getOutputFromHtml($html), 'affiliation-'.$affiliation->getId().'.pdf'

          );*/
    }

    /**
     * @Route("/admin/Affiliation/supprimer/{id}", name="Affiliation_supprimer")
     */
    public function supprimer(Affiliation $Affiliation)
    {
        if ($Affiliation) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($Affiliation);
            $em->flush();
            $this->addFlash('msgSuccess', 'Supression avec sucès');
        }
        return $this->redirectToRoute('Affiliation_liste');

    }

    /**
     * @Route("/admin/Affiliation/chercher", name="Affiliation_chercher")
     */
    public function chercher()
    {
        return $this->render('backOffice/Affiliation/index.html.twig', array());
    }
}
