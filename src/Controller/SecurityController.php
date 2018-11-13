<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; //$encoder (password)

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User;
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

          $hash = $encoder->encodePassword($user, $user->getPassword()); //$user to knwon algorithm bcrypt & $user->getPassword() to know $password
          $user->setPassword($hash); //hash instead of $password

          $manager->persist($user);
          $manager->flush();

          return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'formRegistration' => $form->createView(),
            'page' => 'inscription'
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
      return $this->render('security/login.html.twig', [
            'page' => 'login'
      ]);
    }
}
