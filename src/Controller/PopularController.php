<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11.01.19
 * Time: 3:30
 */

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PopularController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     * @Route("/popular",name="popular")
     */
    public function number()
    {
        return $this->render('Popular/Popular.html.twig');
    }
}

