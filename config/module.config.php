<?php
/**
 * Julien Guittard
 *
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/jguittard/zf-doctrine-datafixture for the canonical source repository
 */

namespace ZF\Doctrine\DataFixture;

return [
    'service_manager' => [
        'factories' => [
            DataFixtureManager::class => DataFixtureManagerFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\HelpController::class => Controller\HelpControllerFactory::class,
            Controller\ImportController::class => Controller\ImportControllerFactory::class,
            Controller\ListController::class => Controller\ListControllerFactory::class,
        ],
    ],
    'console' => [
        'router' => [
            'routes' => [
                'zf-doctrine-data-fixture-help' => [
                    'options' => [
                        'route'    => 'data-fixture:help',
                        'defaults' => [
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Help',
                            'action'     => 'help'
                        ],
                    ],
                ],
                'zf-doctrine-data-fixture-import' => [
                    'options' => [
                        'route'    => 'data-fixture:import <fixture-group> [--append] [--purge-with-truncate]',
                        'defaults' => [
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Import',
                            'action'     => 'import'
                        ],
                    ],
                ],
                'zf-doctrine-data-fixture-list' => [
                    'options' => [
                        'route'    => 'data-fixture:list [<fixture-group>]',
                        'defaults' => [
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\List',
                            'action'     => 'list'
                        ],
                    ],
                ],
            ],
        ],
    ],
];