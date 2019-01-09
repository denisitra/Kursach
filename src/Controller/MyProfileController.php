<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MyProfileController extends AbstractController
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