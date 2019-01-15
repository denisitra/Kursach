<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MyProfileController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/my_profile", name="my_profile")
     */
    public function new(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('About', TextareaType :: class, array('label' => 'Add information about yourself!'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $user2 = $this->getUser();
            $user2->setAbout($user->getAbout());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user2);
            $entityManager->flush();

            return $this->redirectToRoute('my_profile');
        }
        return $this->render('/MyProfile/MyProfile.html.twig', array(
            'registrationForm' => $form->createView(),
            'UserInfo' => $this->getUser(),
        ));
    }


    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * Route("/edit/{id}", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_profile', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('MyProfile/edit.html.twig', [
            'UserInfo' => $user,
            'form' => $form->createView(),
        ]);

    }

}