<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class FollowingController
 * @package App\Controller
 * @Route("/following")
 */
class FollowingController extends AbstractController
{
    /**
     * @Route("/follow/{id}",name="following_follow")
     */
    public function follow(User $userFollow, $id)
    {
        $currentUser=$this->getUser();
        $currentUser->getFollowing()->add($userFollow);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute(
            "post_show",
            ['user' => $userFollow->getUsername(),
                'id'=>$id]
        );
    }
    /**
     * @Route("/unfollow/{id}", name="following_unfollow")
     */
    public function unfollow (User $userToUnfollow, $id)
    {
        /** @var User $currentUser */

        $currentUser = $this->getUser();
        $currentUser->getFollowing()->removeElement($userToUnfollow);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute(
            "post_show",
            ['user' => $userToUnfollow->getUsername(),
                'id'=>$id]
        );
    }
}