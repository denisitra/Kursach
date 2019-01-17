<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends AbstractController
{
    /**
     * @param $id
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/post/{id}", name="post_show")
     *
     */
    public function post_show($id,PostRepository $postRepository)
    {
        $post=$postRepository->find($id);

        return $this->render("post/post.html.twig",['post'=>$post]);
    }
}