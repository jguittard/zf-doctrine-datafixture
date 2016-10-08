<?php

namespace ZF\Doctrine\DataFixture;

use Doctrine\ORM\EntityManagerInterface;
use Zend\ServiceManager\ServiceManager as ZendServiceManager;

/**
 * Class DataFixtureManager
 *
 * @package   ZF\Doctrine\DataFixture
 * @version   1.0
 * @author    Julien Guittard <julien.guittard@me.com>
 * @see       https://github.com/aloha-immo/aloha-immo for the canonical source repository
 * @copyright Copyright (c) 2016 Aloha Immo. (https://www.aloha-immo.com)
 */
class DataFixtureManager extends ZendServiceManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManagerInterface;

    /**
     * @var string
     */
    protected $objectManagerAlias;

    /**
     * Get the entityManagerInterface
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManagerInterface;
    }

    /**
     * @param EntityManagerInterface $entityManagerInterface
     * @return DataFixtureManager
     */
    public function setEntityManager(EntityManagerInterface $entityManagerInterface): DataFixtureManager
    {
        $this->entityManagerInterface = $entityManagerInterface;
        return $this;
    }

    /**
     * Get the objectManagerAlias
     *
     * @return string
     */
    public function getObjectManagerAlias()
    {
        return $this->objectManagerAlias;
    }

    /**
     * @param string $objectManagerAlias
     * @return DataFixtureManager
     */
    public function setObjectManagerAlias(string $objectManagerAlias): DataFixtureManager
    {
        $this->objectManagerAlias = $objectManagerAlias;
        return $this;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $fixtures = [];

        foreach ($this->canonicalNames as $name => $squishedName) {
            $fixtures[] = $this->get($name);
        }

        return $fixtures;
    }
}
