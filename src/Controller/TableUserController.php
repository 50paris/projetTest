<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableUserController extends AbstractController
{
    #[Route('/table/user', name: 'app_table_user')]
    public function index(): Response
    {
            $tableUser = [
                ['prenom' => 'Jean',
                'nom' => 'Abdel',
                'age' => '21'],
                ['prenom' => 'Rober',
                'nom' => 'Molo',
                'age' => '23'],
                ['prenom' => 'Mamadou',
                'nom' => 'Djabate',
                'age' => '18']
            ];
        return $this->render('table_user/index.html.twig', [
            'tableUser' => $tableUser,
        ]);
    }
}
