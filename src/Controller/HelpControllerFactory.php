<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

/**
 * Class HelpControllerFactory
 *
 * @package   ZF\Doctrine\DataFixture\Controller
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class HelpControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var ContainerInterface $services */
        $services = $container->getServiceLocator();
        return new HelpController($services->get('Console'));
    }
}