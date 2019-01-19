<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MyPostsController extends Controller
{
    /**
     * @param $id
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/postss/{id}", name="my_posts_show")
     */
    public function show($id, PostRepository $postRepository,UserRepository $userRepository, Request $request)
    {

        $user=$this->getUser();
        $posts=$user->getPost();


        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 6
        );

        return $this->render('MyPosts/MyPosts.html.twig', ['my' => $posts]);

    }


}