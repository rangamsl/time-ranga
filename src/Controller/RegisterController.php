<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\UserRegisterEvent;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(
        UserPasswordEncoderInterface $passwordEncoder,
        Request $request
       // EventDispatcherInterface $eventDispatcher,
       // TokenGenerator $tokenGenerator
    ) {
        $user = new User();
        $form = $this->createForm(
            UserType::class,
            $user
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            );
            $user->setPassword($password);


            $entityManager = $this->getDoctrine()
                ->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->redirect('time_log_index');
        }

            //$userRegisterEvent = new UserRegisterEvent($user);
            //$eventDispatcher->dispatch(
              //  UserRegisterEvent::NAME,
               // $userRegisterEvent
            //);

           // return $this->redirectToRoute('micro_post_index');
        //}

        return $this->render(
            'register/register.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}