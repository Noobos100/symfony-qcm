<?php

// src/Controller/QcmController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QcmController extends AbstractController
{
    #[Route('/qcm', name: 'app_qcm')]
    public function index(): Response
    {
        $user = $this->getUser();
        $email = $user ? $user->getEmail() : 'guest@example.com';
        $emailFirstPart = explode('@', $email)[0];

        return $this->render('qcm/index.html.twig', [
            'controller_name' => 'QcmController',
            'email_first_part' => $emailFirstPart,
        ]);
    }
}