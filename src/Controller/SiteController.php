<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //par default
use Symfony\Component\Routing\Annotation\Route; //par default
use Symfony\Component\HttpFoundation\Response;

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
      $comments = [
        'Esto es un test',
        'que chimba aprender',
        'esta lindo el dia'
      ];

      return $this->render('site/methode.html.twig', [
        //'title' => ucwords(str_replace('-', ' ', $slug)),
        'comments' => $comments,

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
    public function stages()
    {
      return $this->render('site/stages.html.twig', [

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

    public function admin()
    {
      return $this->render('admin/admin.html.twig', [

      ]);
    }









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
