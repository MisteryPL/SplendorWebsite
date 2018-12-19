<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        // TODO - use Symfony forms & validation
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setEmail($request->request->get('input_email'));
            $user->setLogin($request->request->get('input_login'));
            $user->setUsername($request->request->get('input_username'));
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->request->get('input_password')
            ));
            $user->setRatio('0');
        
        
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
            $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());  // <--------------- Tutaj poprawić

            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->request->get('input_password3')
            ));
            $entityManager->flush();

            return $this->redirectToRoute('menu');
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
            $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());  // <--------------- Tutaj poprawić

            $user->setEmail($request->request->get('input_email3'));
            
            $entityManager->flush();

            return $this->redirectToRoute('menu');
        }
        return $this->render('security/change_email.html.twig');
    }
}
