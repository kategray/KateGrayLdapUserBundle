<?php

namespace KateGray\LdapUserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kategray_ldap_user');

        $rootNode
            ->children()
                ->scalarNode('base_dn')->isRequired()->end()
                ->scalarNode('layout')
                    ->defaultValue('openldap_standard')
                    ->validate()
                        ->ifNotInArray(array('openldap_standard'))
                        ->thenInvalid('The layout %s is not supported')
                    ->end()
                ->end()
                ->arrayNode('user')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('primary_attribute')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('mail')
                            ->validate()
                                ->ifNotInArray(array('mail', 'uid'))
                                ->thenInvalid('The primary attribute %s is not supported')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
