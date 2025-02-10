<?php

// src/Controller/QcmController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QcmController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        $email = $user ? $user->getEmail() : 'guest@example.com';
        $emailFirstPart = explode('@', $email)[0];

        // Fetch users from the API
        $response = $this->client->request('GET', $_ENV['API_URL'] . '/users');
        $data = $response->toArray();
        $users = $data['member'];

        return $this->render('qcm/index.html.twig', [
            'controller_name' => 'QcmController',
            'email_first_part' => $emailFirstPart,
            'users' => $users,
        ]);
    }
}