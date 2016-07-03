<?php

namespace KateGray\LdapUserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class KateGrayLdapUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Handle layouts
        $layout_service = null;
        switch ($config['layout']) {
            case 'openldap_standard':
                $layout_service = 'kategray.ldap_user_bundle.layout.openldap_standard';
        }

        if ($layout_service) {
            $container->setAlias('kategray.ldap_user_bundle.layout', $layout_service);
        }
        $container->setParameter('kategray.ldap_user_bundle.config', $config);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * {@inheritdoc}
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__ . '/../Resources/config/schema';
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return 'http://symfony.com/schema/dic/debug';
    }
}
