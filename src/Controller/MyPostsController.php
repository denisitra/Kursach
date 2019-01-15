<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MyPostsController extends AbstractController
{
    /**
     * @param $id
     * @param TaskRepository $taskRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/postss/{id}", name="my_posts_show")
     */
    public function show($id, TaskRepository $taskRepository)
    {

        $user=$this->getUser();

        $postss = $user->getTask();

        return $this->render('MyPosts/MyPosts.html.twig', ['my' => $postss]);

    }


}