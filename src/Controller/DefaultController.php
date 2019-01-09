<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends AbstractController
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/post", name="post")
     */
    public function new ( Request $request )
    {
        // just setup a fresh $task object (remove the dummy data)
        $post = new Task ();

        $form = $this -> createFormBuilder ( $post )
            -> add ( 'headline' , TextType :: class)
            -> add ( 'teaser' , TextType :: class)
            -> add ( 'text' , TextareaType :: class)
            -> add ( 'tags' , TextType :: class)
            -> add('image', FileType::class)
            -> getForm ();

        $form -> handleRequest ( $request );

        if ( $form -> isSubmitted () && $form -> isValid ()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated


            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this -> redirectToRoute ( 'post' );
        }

        return $this -> render ( 'new.html.twig' , array (
            'form' => $form->createView(),
        ));
    }
}