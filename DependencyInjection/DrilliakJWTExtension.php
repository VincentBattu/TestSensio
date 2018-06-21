<?php

namespace Drilliak\JWTBundle\DependencyInjection;

use Drilliak\JWTBundle\TokenExtractor\HeaderTokenExtractor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class DrilliakJWTExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');

        $container
            ->getDefinition(HeaderTokenExtractor::class)
            ->replaceArgument(0, $config['authorization_header']['prefix'])
            ->replaceArgument(1, $config['authorization_header']['name']);
    }
}
