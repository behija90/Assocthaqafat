<?php

namespace App\Controller\FrontOffice;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembresController extends AbstractController
{

    /**
     * @Route("/membres_fondateurs", name="front_membres")
     */
    public function membres(Request $request)
    {
                return $this->render('frontOffice/membres/index.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_fathi", name="front_fathi")
     */
    public function fathi(Request $request)
    {
        return $this->render('frontOffice/membres/voir_fathi.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_saber", name="front_saber")
     */
    public function saber(Request $request)
    {
        return $this->render('frontOffice/membres/voir_saber.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_naoufel", name="front_naoufel")
     */
    public function naoufel(Request $request)
    {
        return $this->render('frontOffice/membres/voir_naoufel.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_adnan", name="front_adnan")
     */
    public function adnan(Request $request)
    {
        return $this->render('frontOffice/membres/voir_adnan.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_ramla", name="front_ramla")
     */
    public function ramla(Request $request)
    {
        return $this->render('frontOffice/membres/voir_ramla.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_monia", name="front_monia")
     */
    public function monia(Request $request)
    {
        return $this->render('frontOffice/membres/voir_monia.html.twig', array(
        ));
    }

    /**
     * @Route("/membre_salah", name="front_salah")
     */
    public function salah(Request $request)
    {
        return $this->render('frontOffice/membres/voir_salah.html.twig', array(
        ));
    }
}