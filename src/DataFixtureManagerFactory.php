<?php

namespace ZF\Doctrine\DataFixture;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class DataFixtureManagerFactory
 *
 * @package   ZF\Doctrine\DataFixture
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class DataFixtureManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config');
        $request = $container->get('Request');
        $fixtureGroup = $request->params()->get(1);
        if (! isset($config['doctrine']['fixture'][$fixtureGroup])) {
            throw new ServiceNotCreatedException('Fixture group not found: ' . $fixtureGroup);
        }
        if (! isset($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])) {
            throw new ServiceNotCreatedException('Object manager not specified for fixture group ' . $fixtureGroup);
        }
        $dataFixtureConfig = new Config($config['doctrine']['fixture'][$fixtureGroup]);
        $objectManager = $container->get($config['doctrine']['fixture'][$fixtureGroup]['object_manager']);
        $instance = new DataFixtureManager($dataFixtureConfig);
        $instance
            ->setObjectManagerAlias($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])
            ->setEntityManager($objectManager);
        return $instance;
    }
}