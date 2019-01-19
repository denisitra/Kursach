<?php

namespace App\Controller;

use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class PreferencesController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/preferences/{id}", name="preferences_show")
     */
    public function show(TokenStorageInterface $tokenStorage, PostRepository $postRepository,UserRepository $userRepository, Request $request)
    {
        $currentUser = $this->getUser();
        $followers=$currentUser->getFollowing();
        $posts = $postRepository->findAllByUsers($followers->toArray());

        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 6
        );

        return $this->render('preferences/preferences.html.twig', ['posts' => $posts]);
    }
}