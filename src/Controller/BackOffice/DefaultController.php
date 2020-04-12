<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="back_accueil")
     */
    public function index()
    {
        return $this->render('backOffice/default/index.html.twig');
    }

    public function topBar()
    {
        $em = $this->getDoctrine()->getManager();

        $messagesNonVu = $em->getRepository('App:Contact')->findBy(array('vu' => false));
        $nombreMessagesNonVu = count($messagesNonVu);
        $derniersMessages = $em->getRepository('App:Contact')->findBy(array(), array('id' => 'desc'), 5, 0);
        return $this->render('backOffice/includes/topbar.twig', array(
            'derniersMessages' => $derniersMessages,
            'nombreMessgesNonVu' => $nombreMessagesNonVu
        ));
    }

    /**
     * @Route("/vider-le-cache", name="back_clear_cache")
     */
    public function clearCache(KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'cache:clear',
            // (optional) define the value of command arguments
            '--env' => 'prod',
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        $this->addFlash('msgSuccess', 'Le cache a été supprimé');
        return $this->render('backOffice/default/clear_cache.html.twig');
    }

}