<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Console\Adapter\Posix;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use Zend\Console\ColorInterface as Color;
use RuntimeException;

/**
 * Class ListController
 *
 * @package   ZF\Doctrine\DataFixture\Controller
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class ListController extends AbstractActionController
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var Posix
     */
    protected $console;

    /**
     * @var DataFixtureManager
     */
    protected $dataFixtureManager;

    /**
     * ListController constructor.
     * @param array $config
     * @param Posix $console
     * @param DataFixtureManager|null $dataFixtureManager
     */
    public function __construct(array $config, Posix $console, DataFixtureManager $dataFixtureManager = null)
    {
        $this->config = $config;
        $this->console = $console;
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function listAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }
        if ($this->dataFixtureManager) {
            $this->console->write('Group: ', Color::YELLOW);
            $this->console->write($this->params()->fromRoute('fixture-group') . "\n", Color::GREEN);
            $this->console->write('Object Manager: ', Color::YELLOW);
            $this->console->write($this->dataFixtureManager->getObjectManagerAlias() . "\n", Color::GREEN);
            foreach ($this->dataFixtureManager->getAll() as $fixture) {
                $this->console->write(get_class($fixture) . "\n", Color::CYAN);
            }
        } else {
            $this->console->write("All Fixture Groups\n", Color::RED);
            foreach ($this->config as $group => $smConfig) {
                $this->console->write("$group\n", Color::CYAN);
            }
        }
    }
}