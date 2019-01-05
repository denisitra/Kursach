<?php


namespace App;


class AppKernel1 extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        ];

        // ...
    }
}