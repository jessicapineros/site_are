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

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'home' => 'active'
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

      ]);
    }
    /**
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
      return $this->render('site/formations.html.twig', [

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
        'stage_a1_dates' => $stage_a1_dates
      ]);
    }
    /**
     * @Route("/formations/ateliers", name="ateliers")
     */
    public function ateliers()
    {
      return $this->render('site/ateliers.html.twig', [

      ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
      return $this->render('site/contact.html.twig', [

      ]);
    }
    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
      return $this->render('site/mentions.html.twig', [
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
        'stage_a1_dates' => $stage_a1_dates

      ]);
    }
    /**
     * @Route("/admin/new", name="admin_create")
     * @Route("/admin/{id}/edit"), name="blog_edit")
     */
    public function form(StageA1 $stageA1= null, Request $request, ObjectManager $manager)
    {
      if(!$stageA1){
        $stageA1 = new StageA1();
      }

      $formStageA1 = $this->createFormBuilder($stageA1)
                   ->add('date', TextType::Class)
                   ->getForm();

      $formStageA1->handleRequest($request);

      if($formStageA1->isSubmitted() && $formStageA1->isValid()){

        $manager->persist($stageA1);
        $manager->flush();

        return $this->redirectToRoute('admin');
      }

      dump($stageA1);

      dump($request);
      return $this->render('site/create.html.twig', [
          'id' => $stageA1->getId(),
          'formStageA1' => $formStageA1->createView()
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
