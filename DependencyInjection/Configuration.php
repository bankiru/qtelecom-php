<?php

namespace Bankiru\Sms\QtSms\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /** {@inheritdoc} */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $root    = $builder->root('qt_sms');

        $root->children()->scalarNode('login')->isRequired();
        $root->children()->scalarNode('password')->isRequired();
        $root->children()->scalarNode('url')->defaultValue('https://bulk.sms-online.com/');
        $root->children()->scalarNode('sender')->isRequired();

        return $builder;
    }
}
