<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

class WelcomeController extends AbstractController
{
   /**
    * @Route("/", name="welcome")
    */
    public function index(TranslatorInterface $translator)
    {
        $welcome = $translator->trans('Welcome');
        $welcome_msg = $translator->trans('Welcome msg');
        $newsest = $translator->trans('Newsest');

        return $this->render('welcome/index.html.twig', [
            'title' => $welcome,
            'welcome_msg' => $welcome_msg,
            'newsest' => $newsest,
        ]);
    }
}

?>
