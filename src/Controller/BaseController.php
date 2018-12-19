<?php
    namespace App\Controller;

    use App\Entity\User;

    use Symfony\Component\HttpFoundation\Response;
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
        public function support()
        {
            return $this->render('support.html.twig');
        }

        /**
         *  @Route("/rules", name="rules")
         */
        public function rules()
        {
            return $this->render('rules.html.twig');
        }


        /**
         * @Route("/profile/menu", name="menu")
         */
        public function usermenu()
        {
            return $this->render('usermenu.html.twig');
        }

        /**
         * @Route("/recovery", name="recovery")
         */
        public function password_recovery()
        {
            return $this->render('password_recovery.html.twig');
        }

    }