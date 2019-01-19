<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Like;
use App\Form\PostType;
use App\Repository\LikeRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    public function __construct()
    {

    }

    /**
     * @param $id
     * @param PostRepository $postRepository
     *
     * @param Request $request
     * @param LikeRepository $likeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/post/{id}", name="post_show")
     */
    public function postShow($id,PostRepository $postRepository, Request $request, LikeRepository $likeRepository)
    {
//        $like = $likeRepository->findAll();
        $post=$postRepository->find($id);
        $comments = $post->getComments()->toArray();
   //     $like = $post->getLikes();
//        $like = $this->getDoctrine()
//                      ->getRepository(Like::class)
//                      ->findOneBy(['user' => $this->getUser()->getId(), 'post' => $post->getId()]);

     //   $like = $this->getUser()->getLikes();




//        $like = new Like();
//        $like->setIsLiked(true);
//        $like->setPost($post);
//        $like->addUser($this->getUser());

        return $this->render(
      "post/post.html.twig", [
                'post'=>$post,
                'comments' => $comments,
              //  'like' => $like
            ]);
    }

    /**
     * @param $id
     * @param PostRepository $postRepository
     *
     * @Route("/post/{id}/addComment/{text}", name="comment_add")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addComment($id, $text, PostRepository $postRepository){
        $em = $this->getDoctrine()->getManager();
        $post = $postRepository->find($id);

        $comment = new Comment();
        $comment->setText($text);
        $comment->setPost($post);
        $comment->setUser($this->getUser());

        $em->persist($post);
        $em->flush();

        return $this->render(
            "post/post.html.twig", [
            'post'=>$post,
        ]);

    }
}