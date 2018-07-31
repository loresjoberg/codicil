<?php

namespace LoreSjoberg\Codicil\Core;

use Psr\Container\ContainerException;
use Psr\Container\NotFoundException;

/**
 * Front-end to fluent queries of WordPress objects.
 *
 * This provides a unified interface to WordPress queries.
 * It implements the PSR-11 container interface, so that you can
 * get() the curator that will complete the query, but we
 * also have select() as an alias of get(), to make it feel
 * more like a query interface.
 *
 * // TODO: Add the ability to provide other curators at runtime.
 *
 * Class QueryContainer
 * @package LoreSjoberg\Codicil\Core
 */
class QueryContainer implements QueryContainerInterface
{

    /**
     * @var CuratorInterface[]
     */
    private $curators = [];

    public function __construct(array $curators)
    {
        foreach ($curators as $label => $curator) {
            $implements = class_implements($curator);
            if (!in_array(CuratorInterface::class, $implements)) {
                throw new ContainerException('Invalid object, must implement CuratorInterface.');
            }
        }
        $this->curators = $curators;
    }

    /**
     * @param string $identifier
     *
     * @throws NotFoundException
     * @return CuratorInterface
     */
    public function get($identifier)
    {
        if (isset($this->curators[$identifier])) {
            return $this->curators[$identifier];
        }

        throw new NotFoundException();
    }

    /**
     * @param string $identifier
     *
     * @return CuratorInterface
     */
    public function select($identifier)
    {
        return $this->get($identifier);
    }

    /**
     * @param string $identifier
     *
     * @return bool
     */
    public function has($identifier)
    {
        if (isset($this->curators[$identifier])) {
            return true;
        }

        return false;
    }
}