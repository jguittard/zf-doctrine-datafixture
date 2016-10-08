<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;
use ZF\Doctrine\DataFixture\DataFixtureManager;

/**
 * Class ListControllerFactory
 *
 * @package   ZF\Doctrine\DataFixture\Controller
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class ListControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var ContainerInterface $services */
        $services = $container->getServiceLocator();

        $config = $services->get('Config');
        $console = $services->get('Console');
        $dataFixtureManager = $services->get(DataFixtureManager::class);

        return new ListController($config['doctrine']['fixture'], $console, $dataFixtureManager);
    }
}