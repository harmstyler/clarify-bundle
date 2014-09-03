<?php

namespace HarmsTyler\ClarifyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class HarmsTylerClarifyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $defaultApp = $config['default_app'];
        if (!count($config['apps'])) {
            $config['apps'][$defaultApp] = array();
        } elseif (count($config['apps']) === 1) {
            $defaultApp = key($config['apps']);
        }

        $apps = array();
        foreach ($config['apps'] as $name => $appOptions) {
            $appName = sprintf('clarify.app.%s', $name);
            $bundleClass = 'Clarify\Bundle';
            $bundleDefinition = new Definition($bundleClass, array($appOptions['api_key']));
            $apps[$name] = new Reference($appName);

            $container->setDefinition($appName, $bundleDefinition);

            if ($name == $defaultApp) {
                $container->setAlias('clarify.app', $appName);
            }
        }
    }
}
