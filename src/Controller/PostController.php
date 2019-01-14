<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends AbstractController
{
    /**
     * @param $id
     * @param TaskRepository $taskRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/post/{id}", name="post_show")
     *
     */
    public function post_show($id,TaskRepository $taskRepository)
    {
        $post=$taskRepository->find($id);

        return $this->render("post/post.html.twig",['post'=>$post]);
    }
}