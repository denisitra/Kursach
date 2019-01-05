<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends AbstractController
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/task", name="task")
     */
    public function new ( Request $request )
    {
        // just setup a fresh $task object (remove the dummy data)
        $task = new Task ();

        $form = $this -> createFormBuilder ( $task )
            -> add ( 'task' , TextType :: class )
            -> add ( 'dueDate' , DateType :: class )
            -> add ( 'save' , SubmitType :: class , array ( 'label' => 'Create Task' ))
            -> getForm ();

        $form -> handleRequest ( $request );

        if ( $form -> isSubmitted () && $form -> isValid ()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $task = $form -> getData ();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this -> redirectToRoute ( 'task' );
        }

        return $this -> render ( 'new.html.twig' , array (
            'form' => $form->createView(),
        ));
    }
}