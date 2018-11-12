<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //par default
use Symfony\Component\Routing\Annotation\Route; //par default
use Symfony\Component\HttpFoundation\Response;
Use App\Entity\StageA1; //table Stage_a1 in sql
use App\Repository\StageA1Repository;
use Symfony\Component\HttpFoundation\Request; // methode create -> requete http
use Doctrine\Common\Persistence\ObjectManager; //pour $manager->persist()
use Symfony\Component\Form\Extension\Core\Type\TextType; //type imput text form
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\StageA1Type;

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
    public function stages()//(StageA1Repository $repo)
    {
      $repo = $this->getDoctrine()->getRepository(StageA1::class);
      $stage_a1_dates = $repo->findAll();

      return $this->render('site/stages.html.twig', [
        'page' => "formations",
        'stage_a1_dates' => $stage_a1_dates
      ]);
    }
    /**
     * @Route("/formations/ateliers", name="ateliers")
     */
    public function ateliers()
    {
      return $this->render('site/ateliers.html.twig', [
        'page' => "formations",
      ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
      return $this->render('site/contact.html.twig', [
        'page' => 'contact'

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
      $repo = $this->getDoctrine()->getRepository(StageA1::class);
      $stage_a1_dates = $repo->findAll();

      return $this->render('site/admin.html.twig', [
        'page' => 'admin',
        'stage_a1_dates' => $stage_a1_dates

      ]);
    }
    /**
     * @Route("/admin/new", name="admin_create")
     * @Route("/admin/{id}/edit"), name="blog_edit")
     */
    public function form(StageA1 $stageA1= null, Request $request, ObjectManager $manager) //sur new el article est null sur edit contient les donnes de stageA1 con el id que le pasamos {id}/edit
    {
      //paramconverter : convertit un parametre en un entité ej: Strage A1 $stageA!
      if(!$stageA1){// si stageA1 est null
        $stageA1 = new StageA1();
      }

      /*
      $formStageA1 = $this->createFormBuilder($stageA1)
                   ->add('date', TextType::Class, array('label' => 'Date :'))
                   ->getForm();
      //en vez de esto se puede crear la clase con php bin/console make:form y se pone la linea de abajo
                 */
      $formStageA1 = $this->createForm(StageA1Type::class, $stageA1);

      $formStageA1->handleRequest($request); //tratar los datos

      if($formStageA1->isSubmitted() && $formStageA1->isValid()){

        $manager->persist($stageA1);
        $manager->flush();

        return $this->redirectToRoute('admin');
      }

      dump($stageA1);

      dump($request);
      return $this->render('site/create.html.twig', [
          'page' => 'form',
          'id' => $stageA1->getId(),
          'formStageA1' => $formStageA1->createView(),
          'editMode' => $stageA1->getId() !== null //si el id es diferente de null dara true
      ]);
    }

//si $page == about








    /**
     * @Route("/blog/12", name="blog_show")
     */
    public function show()
    {
      return $this->render('site/show.html.twig', [

      ]);
    }




    /*
      @Route("/contact/{slug}", name="contact")
     */
    //public function contact($slug){
      //return new Response(sprintf('Este es el numero: %s', $slug));  }
      //
      //<!--  <li><a href="{{path('contact',{slug: 'test-de-prueba'})}}">Contact</a></li> -->

















}
