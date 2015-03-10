<?php

/**
 * This file is part of the T3DatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace T3\DatatablesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package T3\DatatablesBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('t3_datatables');

        $rootNode
            ->children()
                ->arrayNode('default_layout')->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('page_length')
                            ->defaultValue(10)
                            ->min(1)
                        ->end()
                        ->booleanNode('server_side')->defaultTrue()->end()
                        ->booleanNode('processing')->defaultTrue()->end()
                        ->booleanNode('individual_filtering')->defaultFalse()->end()
                        ->arrayNode('templates')->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('base')->defaultValue('T3DatatablesBundle:Datatable:datatable.html.twig')->end()
                            ->scalarNode('html')->defaultValue('T3DatatablesBundle:Datatable:datatable_html.html.twig')->end()
                            ->scalarNode('js')->defaultValue('T3DatatablesBundle:Datatable:datatable_js.html.twig')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
