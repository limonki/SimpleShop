<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();

class UserController extends AbstractController
{
  /**
  * @Route("/login", name="login")
  */
  public function index(TranslatorInterface $translator)
  {
    $title = $translator->trans('Login title');
    $log_in_msg = $translator->trans('Log In');
    $sign_in = $translator->trans('Sign In');
    $sign_up = $translator->trans('Sign Up');
    $forgot_your_password = $translator->trans('Forgot your password');
    $click_here = $translator->trans('Click here');
    $email_value = $translator->trans('Email value');
    $password_value = $translator->trans('Password value');

    return $this->render('user/index.html.twig', array(
        'title'         => $title,
        'log_in_msg'    => $log_in_msg,
        'sign_in'       => $sign_in,
        'sign_up'       => $sign_up,
        'forgot_your_password' => $forgot_your_password,
        'click_here'    => $click_here,
        'email_value'   => $email_value,
        'password_value'=> $password_value,
    ));
  }

  /**
  * @Route("/authenticate", name="authenticate")
  */
  public function authenticate(TranslatorInterface $translator, AuthenticationUtils $authentication_utils, Request $request)
  {
    global $session;

    if($request->request->get('email') && $request->request->get('password'))
    {
      $email = $request->request->get('email');
      $password = $request->request->get('password');

      $repository = $this->getDoctrine()->getRepository(User::class);

      $user = $repository->findOneBy(['username' => $email, 'password' => $password]);

      if(!$user) $arr = ['output' => 'Error'];
      else
      {
        $session->set("authorized", "true");
        $arr = ['output' => 'Success'];
      }

      return new JsonResponse($arr);
    }

    return $this->render('user/index.html.twig');
  }
}

?>
