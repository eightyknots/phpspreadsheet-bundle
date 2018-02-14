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
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder->root('yectep_phpoffice');

        return $builder;
    }

}