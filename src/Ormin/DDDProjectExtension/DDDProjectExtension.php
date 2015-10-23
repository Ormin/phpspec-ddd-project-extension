<?php

namespace Ormin\DDDProjectExtension;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;

class DDDProjectExtension implements ExtensionInterface
{
    /**
     * @param ServiceContainer $container
     */
    public function load(ServiceContainer $container)
    {
        $container->set('matchers.value', function (ServiceContainer $c) {
            return new ValueMatcher($c->get('formatter.presenter'));
        });
    }

}