<?php

namespace App\Menu;


use Knp\Menu\FactoryInterface ;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerAwareInterface ;
use Symfony\Component\DependencyInjection\ContainerAwareTrait ;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait ;

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     * @Route("rega")
     */
    public function mainMenu ( FactoryInterface $factory , array $options )
    {
        $menu = $factory -> createItem ( 'root' );

        $menu -> addChild ( 'Home' , [ 'route' => 'homepage' ]);

        // access services from the container!
        $em = $this -> container -> get ( 'doctrine' ) -> getManager ();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em -> getRepository ( 'AppBundle:Blog' ) -> findMostRecent ();

        $menu -> addChild ( 'Latest Blog Post' , [
            'route' => 'blog_show' ,
            'routeParameters' => [ 'id' => $blog -> getId ()]
        ]);

        // create another menu item
        $menu -> addChild ( 'About Me' , [ 'route' => 'about' ]);
        // you can also add sub levels to your menus as follows
        $menu [ 'About Me' ] -> addChild ( 'Edit profile' , [ 'route' => 'edit_profile' ]);

        // ... add more children

        return $menu ;
    }
}
