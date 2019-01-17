<?php

namespace App\Controller;

use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class PreferencesController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/preferences/{id}", name="preferences_show")
     */
    public function show(TokenStorageInterface $tokenStorage, PostRepository $postRepository,UserRepository $userRepository)
    {
        $currentUser = $this->getUser();
        $followers=$currentUser->getFollowing();
        $posts = $postRepository->findAllByUsers($followers->toArray());

        return $this->render('preferences/preferences.html.twig', ['posts' => $posts]);
    }
}