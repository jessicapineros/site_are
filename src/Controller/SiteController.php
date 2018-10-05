<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
      return $this->render('site/about.html.twig', [
          'page' => "about",
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
     * @Route("/blog/12", name="blog_show")
     */
    public function show()
    {
      return $this->render('site/show.html.twig', [

      ]);
    }

    /**
     * @Route("/contact/{slug}", name="contact")
     */
    public function test_show($slug)
    {
      return new Response(sprintf('Este es el numero: %s', $slug));
    }
}
