<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use RuntimeException;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\Doctrine\DataFixture\DataFixtureManager;

/**
 * Class ImportController
 *
 * @package   ZF\Doctrine\DataFixture\Controller
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class ImportController extends AbstractActionController
{
    /**
     * @var DataFixtureManager
     */
    protected $dataFixtureManager;

    /**
     * ImportController constructor.
     * @param DataFixtureManager $dataFixtureManager
     */
    public function __construct(DataFixtureManager $dataFixtureManager)
    {
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function importAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }
        $loader = new Loader();
        $purger = new ORMPurger();
        foreach ($this->dataFixtureManager->getAll() as $fixture) {
            $loader->addFixture($fixture);
        }
        if ($this->params()->fromRoute('purge-with-truncate')) {
            $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        }
        $executor = new ORMExecutor($this->dataFixtureManager->getEntityManager(), $purger);
        $executor->execute(
            $loader->getFixtures(),
            (bool) $this->params()->fromRoute('append')
        );
    }
}
