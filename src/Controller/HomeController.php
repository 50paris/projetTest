<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/index/{service}', name: 'index')]
    public function index($service): Response
    {
        return $this->render('home/index.html.twig', [
            'name' => $service,
            'path' => 'dzdz'
        ]);
    }

    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        return $this->render('template.html.twig');
    }

    public function sayHello($name,$firstName): Response
    {
        return $this->render('home/hello.html.twig',[
            'name' => $name,
            'firstName' => $firstName
        ]);
    }

    
    #[Route('/home', name: 'home')]
    public function home(): Response
    {   
        return $this->forward('App\Controller\HomeController::index', [
            'name' => 'index',
        ]);
    }
    #[Route(
        '/multiplication/{nb1<\d+>}/{nb2<\d+>}',
        name: 'multiplication'
    )]
    public function multiplication($nb1, $nb2): Response
    {   
        $result=$nb1*$nb2;
        return new Response("<h1>$result</h1>");
    }
    
}
/*return new Response(
    content:"<head>
                <title>Home</title>
                <body><h1>welcome</h1></body>
            </head>"
);*/