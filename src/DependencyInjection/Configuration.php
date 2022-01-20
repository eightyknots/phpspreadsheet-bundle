<?php

namespace Yectep\PhpSpreadsheetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configures the class with standard options.
 *
 * @package Yectep\PhpSpreadsheetBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (! method_exists('Symfony\Component\Config\Definition\Builder\TreeBuilder', 'getRootNode')) {
            // This is the pre 4.2 way
            $builder = new TreeBuilder();
            $builder->root('yectep_phpoffice');
        } else {
            $builder = new TreeBuilder('yectep_phpoffice');
            $builder->getRootNode($builder, 'yectep_phpoffice');
        }


        return $builder;
    }

}
