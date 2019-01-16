<?php
    namespace App\Controller;

    use App\Entity\User;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;


    class BaseController extends Controller {

        /**
         *  @Route("/", name="index")
         */

        public function index()
        {
            return $this->render('index.html.twig');
        }

        /**
         *  @Route("/ranking", name="ranking")
         */
        public function ranking()
        {
            $posts = $this->getDoctrine()->getRepository(User::class)->findBy([], ['Ratio' => 'DESC']);;
            return $this->render('ranking.html.twig', ['posts' => $posts]);
        }

        /**
         *  @Route("/support", name="support")
         */
        public function support(Request $request, \Swift_Mailer $mailer)
        {
            if($request->isMethod('POST'))
            {
                $email = $request->request->get('input_email');
                $input = $request->request->get('input_problem');
                $mess = "From: " . $email . PHP_EOL . PHP_EOL . $input;

                $message = (new \Swift_Message('Support contact'))
                    ->setFrom($email)
                    ->setTo('splendor.inzynierski@gmail.com')
                    ->setBody($mess);

                $mailer->send($message);
                return $this->redirectToRoute('support');
            }
            return $this->render('support.html.twig');
        }

        /**
         *  @Route("/rules", name="rules")
         */
        public function rules()
        {
            return $this->render('rules.html.twig');
        }

    }
