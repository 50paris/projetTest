<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionsController extends AbstractController
{
    #[Route('/sessions', name: 'sessions')]
    public function index(Request $request): Response
    {
        $session = $request -> getSession();
        if($session->has('nbVisite')){
            $nbVisite = $session->get('nbVisite')+1;
        }else{
            $nbVisite = 1;
        }
        $session->set('nbVisite',$nbVisite);
        return $this->render('sessions/index.html.twig',['name' => 'mike']);
    }
}
