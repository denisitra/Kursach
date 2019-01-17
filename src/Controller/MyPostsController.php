<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MyPostsController extends AbstractController
{
    /**
     * @param $id
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/postss/{id}", name="my_posts_show")
     */
    public function show($id, PostRepository $postRepository,UserRepository $userRepository)
    {

        $user=$this->getUser();
        $posts=$user->getPost();

        return $this->render('MyPosts/MyPosts.html.twig', ['my' => $posts]);

    }


}