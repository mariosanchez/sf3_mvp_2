<?php

namespace BeerScore\BeerBundle;

use BeerScore\BeerBundle\CompilerPass\DoctrineMappingCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BeerScoreBeerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineMappingCompilerPass());
    }
}
