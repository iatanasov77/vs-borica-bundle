<?php namespace Vankosoft\BoricaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class VSBoricaBundle extends Bundle
{
    public function build( ContainerBuilder $container ): void
    {
        parent::build( $container );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new \Vankosoft\BoricaBundle\DependencyInjection\VSBoricaExtension();
    }
}
