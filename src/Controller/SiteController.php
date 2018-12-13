<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //par default
use Symfony\Component\Routing\Annotation\Route; //par default
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request; // requete http /recibir datos por post
use Doctrine\Common\Persistence\ObjectManager; //pour $manager->persist()

Use App\Entity\DatesFormations; //table dates_formation in DB
Use App\Entity\Categogy;
Use App\Entity\Contact;
use App\Repository\DatesFormationsRepository;
use App\Repository\CategoryRepository;
use App\Repository\ContactRepository;

use App\Form\DatesFormationsType;
use App\Form\ContactType;
use Symfony\Component\Form\Extension\Core\Type\TextType; //type imput text form
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SiteController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'page' => 'active'
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {

      return $this->render('site/about.html.twig', [
          'page' => "about",
          'about' => 'active',
          'bienvenue' => "bienveue ici les amis",
      ]);
    }

    /**
     * @Route("/methode", name="methode")
     */
    public function methode()
    {
      return $this->render('site/methode.html.twig', [
        'page' => "methode",
      ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
      return $this->render('site/formations.html.twig', [
        'page' => "formations",
      ]);
    }

    /**
     * @Route("/formations/stages", name="stages")
     */
    public function stages()//(DatesFormationsRepository $repo)
    {
      $repo = $this->getDoctrine()->getRepository(DatesFormations::class);
      $dates_formations = $repo->findAll();

      return $this->render('site/stages.html.twig', [
        'page' => "formations",
        'dates_formations' => $dates_formations
      ]);
    }
    /**
     * @Route("/formations/ateliers", name="ateliers")
     */
    public function ateliers()
    {
      $repo = $this->getDoctrine()->getRepository(DatesFormations::class);
      $dates_formations = $repo->findAll();

      return $this->render('site/ateliers.html.twig', [
        'page' => "formations",
        'dates_formations' => $dates_formations
      ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {
      $contact = new Contact;
      $formContact = $this->createForm(ContactType::class, $contact);
      $formContact->handleRequest($request);

      if($formContact->isSubmitted() && $formContact->isValid()){
        //$contactFormData = $formContact->getData();
        //$//https://codereviewvideos.com/course/symfony-4-beginners-tutorial/video/send-email-symfony-4
        $manager->persist($contact);
        $manager->flush();

        $message = (new \Swift_Message('Formulaire de Contact Site ARE'))
        ->setFrom($contact->getEmail())
        ->setTo('jessicapineros@gmail.com', 'jeka99@hotmail.com')//mail de monnique et anneL
        ->setBody(
            $this->renderView(
                  // templates/emails/registration.html.twig
                  'site/email.html.twig',
                  array('name' => $contact->getName(),
                        'email' => $contact->getEmail(),
                        'object' =>$contact->getObject(),
                        'message'=>$contact->getMessage(),
                        )
              ),
              'text/html'
        //->setBody(
          //  $contact->getMessage(),
            //'text/plain'
        );
        $mailer->send($message);

        return $this->render('site/flash_messages.html.twig', [
          'page' => 'contact',
        ]);
      }

      return $this->render('site/contact.html.twig', [
        'page' => 'contact',
        'formContact' => $formContact->createView()
      ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
      return $this->render('site/mentions.html.twig', [
        'page' => 'mentions'
      ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
      $repo = $this->getDoctrine()->getRepository(DatesFormations::class);
      $dates_formations = $repo->findAll();

       $this->denyAccessUnlessGranted('ROLE_ADMIN');
       //https://symfony.com/doc/current/security.html

      return $this->render('site/admin.html.twig', [
        'page' => 'admin',
        'dates_formations' => $dates_formations
      ]);
    }
    /**
     * @Route("/admin/new", name="admin_create")
     * @Route("/admin/{id}/edit"), name="admin_edit")
     */
    public function createEditDates(DatesFormations $DatesFormations= null, Request $request, ObjectManager $manager) //sur new el article est null sur edit contient les donnes de DatesFormations con el id que le pasamos {id}/edit
    {
      //paramconverter : convertit un parametre en un entité ej: Strage A1 $stageA!
      if(!$DatesFormations){// si DatesFormations est null
        $DatesFormations = new DatesFormations();
      }
      /*
      $formDatesFormations = $this->createFormBuilder($DatesFormations)
                   ->add('date', TextType::Class, array('label' => 'Date :'))
                   ->getForm();
      //en vez de esto se puede crear la clase con php bin/console make:form y se pone la linea de abajo
                 */
      $formDatesFormations = $this->createForm(DatesFormationsType::class, $DatesFormations);

      $formDatesFormations->handleRequest($request); //tratar los datos

      if($formDatesFormations->isSubmitted() && $formDatesFormations->isValid()){

        $manager->persist($DatesFormations);
        $manager->flush();

        return $this->redirectToRoute('admin');
      }
      //dump($DatesFormations);
      //dump($request);
      return $this->render('site/create.html.twig', [
          'page' => 'form',
          'id' => $DatesFormations->getId(),
          'formDatesFormations' => $formDatesFormations->createView(),
          'editMode' => $DatesFormations->getId() !== null //si el id es diferente de null dara true
      ]);
    }

    /**
     * @Route("/admin/{id}/delete"), name="admin_delete")
     */
    public function deleteDates(DatesFormations $DatesFormations, ObjectManager $manager)
    {
      if ($DatesFormations) {

        //$manager = $this->getDoctrine()->getManager(); //sobra porque ya se instancio arriba
        $manager->remove($DatesFormations);
        $manager->flush();

        return $this->redirectToRoute('admin');
      }
    }

}
