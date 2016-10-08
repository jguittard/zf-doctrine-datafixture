<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\Posix;
use Zend\Mvc\Controller\AbstractActionController;
use RuntimeException;

/**
 * Class HelpController
 *
 * @package   ZF\Doctrine\DataFixture\Controller
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 */
class HelpController extends AbstractActionController
{
    /**
     * @var Posix
     */
    protected $console;

    /**
     * HelpController constructor.
     * @param Posix $console
     */
    public function __construct(Posix $console)
    {
        $this->console = $console;
    }

    public function helpAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }
        $help = <<<EOF
Usage:
    data-fixture:import group_name
Options:
    --purge-with-truncate
        If specified will purge the object manager's tables using truncate
        before running fixtures.
    --append
        Will append values to the tables.  If you are re-running fixtures be
        sure to use this.  If you do not specify this option the object
        manager's tables will be emptied!
EOF;
        $this->console->write($help);
    }
}