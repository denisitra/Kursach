<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create_post", name="post")
     */
    public function new ( Request $request )
    {
// just setup a fresh $task object (remove the dummy data)
        $tsk = new Post();

        $form = $this -> createFormBuilder ( $tsk )
            -> add ( 'headline' , TextType :: class)
            -> add ( 'teaser' , TextType :: class)
            -> add ( 'text' , TextareaType :: class)
            -> add ( 'tags' , TextType :: class)
            -> getForm ();

        $form -> handleRequest ( $request );

        if ( $form -> isSubmitted () && $form -> isValid ())
        {

            $tsk->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tsk);
            $entityManager->flush();

            return $this -> redirectToRoute ( 'post' );
        }

        return $this -> render ( 'new.html.twig' , array (
            'form' => $form->createView(),
        ));

    }

    /**
     * @param $id
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/posts/{id}", name="posts_show")
     */
    public function show($id,PostRepository $postRepository,Request $request)
    {
        $posts = $postRepository->findAll(['id'=>$id]);

        if (!$posts) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1), 6
        );
        return $this->render('allposts/allposts.html.twig', ['posts' => $result]);
    }

}