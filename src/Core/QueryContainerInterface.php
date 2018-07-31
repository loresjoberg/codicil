<?php

namespace LoreSjoberg\Codicil\Core;

use Psr\Container\ContainerInterface;

interface QueryContainerInterface extends ContainerInterface
{
    /**
     * @param string $identifier
     *
     * @return CuratorInterface
     */
    public function select($identifier);

}