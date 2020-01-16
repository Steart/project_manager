<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DashboardController extends SecurityController
{
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();

        return $this->render('dashboard/dashboard.html.twig', ['user' => $user]);
    }
}