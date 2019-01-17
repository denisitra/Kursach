<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index()
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
     * @Route("/comment/add/{id}", name="comment")
     */
    public function add($id, Request $request)
    {
        $request->getRequestUri();
        $data = json_decode($request->getContent(), true);

        $text = $data["text"];
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);

        $comment = new Comment();
        $comment->setUser($this->getUser());
        $comment->setPost($post);
        $comment->setText($text);

        $em->persist($comment);
        $em->flush();

        return $this->json(['status' => 'ok']);

    }


}
