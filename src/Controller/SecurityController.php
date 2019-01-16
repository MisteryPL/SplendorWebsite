<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('Will be intercepted before getting here');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setEmail($request->request->get('input_email'));
            $user->setLogin($request->request->get('input_login'));
            $user->setUsername($request->request->get('input_username'));
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->request->get('input_password')
            ));
            $user->setRozegrane('0');
            $user->setWygrane('0');
            $user->setRatio('0');
            $user->setQuestion($request->request->get('input_question'));
            $user->setAnswer($request->request->get('input_answer'));
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/rejestracja.html.twig');
    }

    /**
     * @Route("/profile/change_password", name="app_password_change")
     */
    public function change_password(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST'))
        {
            $entityManager = $this->getDoctrine()->getManager();

            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();

            if($request->request->get('input_password2') == $request->request->get('input_password3'))
            {
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $request->request->get('input_password3')
                ));
                $entityManager->flush();

                return $this->redirectToRoute('index');
            }
        }
        return $this->render('security/change_password.html.twig');
    }

     /**
     * @Route("/profile/change_email", name="app_email_change")
     */
    public function change_email(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $entityManager = $this->getDoctrine()->getManager();

            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();
            
            if($request->request->get('input_email2') == $request->request->get('input_email3'))
            {
                $user->setEmail($request->request->get('input_email3'));
                $entityManager->flush();
                return $this->redirectToRoute('index');
            }
        }
        return $this->render('security/change_email.html.twig');
    }

    /**
     * @Route("/recovery", name="recovery")
     */
    public function password_recovery(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['login' => $request->request->get('input_login')]);

            $check_question = $user->getQuestion();
            $input_question = $request->request->get('input_question');
            $check_answer = $user->getAnswer();
            $input_answer = $request->request->get('question_answer');

            if($check_question == $input_question && $check_answer == $input_answer)
            {
                $this->get('session')->set('user_temp', $request->request->get('input_login'));
                return $this->redirectToRoute('reset');
            }         
            else
            {
                return $this->redirectToRoute('recovery');
            }     
        }
        return $this->render('password_recovery.html.twig');
    }

    /**
     * @Route("/reset/password_reset", name="reset")
     */
    public function password_reset(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST'))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['login' => $this->get('session')->get('user_temp')]);

            if($request->request->get('input_password2') == $request->request->get('input_password3'))
            {
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $request->request->get('input_password3')
                ));

                $entityManager->flush();
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('password_reset.html.twig');
    }
}
