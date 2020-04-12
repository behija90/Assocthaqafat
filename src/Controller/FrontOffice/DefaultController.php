<?php



namespace App\Controller\FrontOffice;



use App\Entity\Contact;

use App\Entity\News;

use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;



class DefaultController extends AbstractController

{

/**
 * Change the locale for the current user
 *
 * @param String $language
 * @return array
 *
 * @Route("/setlocale/{language}", name="setlocale")
 */
public function setLocaleAction($language = null)
{
    if($language != null)
    {
        // On enregistre la langue en session
        $this->get('session')->set('_locale', $language);
    }

    // on tente de rediriger vers la page d'origine
    $url = $this->container->get('request')->headers->get('referer');
    if(empty($url))
    {
        $url = $this->container->get('router')->generate('home', array('_local'=>$language));
    }

    return new RedirectResponse($url);
}

    /**
     * @Route("/change-locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        // On stocke la langue demandée dans la session
        $request->getSession()->set('_locale', $locale);

        // On revient sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }


    /**
     * @Route("/", name="front_page_accueil")
     */
    public function accueil(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $derniersNews = $em->getRepository(News::class)->findBy(array(), array('id'=>'desc'), 5, 0);

        return $this->render('frontOffice/default/accueil.html.twig', array(

            'derniersNews'=> $derniersNews

        ));

    }

    public function barreNews()
    {
        $em = $this->getDoctrine()->getManager();
        $derniersNews = $em->getRepository(News::class)->findBy(array(), array('id'=>'desc'), 5, 0);

        return $this->render('frontOffice/includes/barre_news.html.twig', array(
            'derniersNews'=> $derniersNews

        ));

    }



    /**

     * @Route("/donnees", name="front_page_donnees")

     */

    public function donnees()

    {

        $em = $this->getDoctrine()->getManager();



        return $this->render('frontOffice/default/donnees2.html.twig');

    }





    /**

     * @Route("/qui-sommes-nous", name="front_apropos")

     */

    public function apropos()

    {

        return new Response('page apropos front');

    }





    /**

     * @Route("/contactez-nous", name="front_contact")

     */

    public function contact(Request $request)

    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);

            $em->flush();

            $this->addFlash('msgSuccess', 'تم إرسال رسالتكم بنجاح');



            return $this->redirectToRoute('front_contact');

        }



        return $this->render('frontOffice/default/contact.html.twig', array(

            'form' => $form->createView()

        ));

    }



}