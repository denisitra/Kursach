<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     * @Route("/home",name="home")
     */
    public function number()
    {
        return $this->render('homepage/homepage.html.twig');
    }
}

