<?php

namespace LoreSjoberg\Codicil\Curators;

use LoreSjoberg\Codicil\Core\Curator;
use LoreSjoberg\Codicil\Core\CuratorInterface;

/**
 * Class UserCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class UserCurator extends Curator implements CuratorInterface
{


    final protected function prepareCoreArgs()
    {
        $args = [
            'number' => $this->constraints['limit'],
            'exclude' => $this->constraints['exclude'],
            'include' => $this->constraints['ids'],
            'offset' => $this->constraints['offset'],
            'order' => strtoupper($this->constraints['order']['direction']),
            'orderby' => $this->constraints['order']['by'],
            'has_published_posts' => $this->constraints['isAuthor']
        ];

        return $args;

    }

    final protected function getDefaultConstraints() {
        return [
            'limit' => '',
            'exclude' => null,
            'ids' => null,
            'offset' => '',
            'order' => [
                'by' => 'login',
                'direction' => 'ASC'
            ],
            'isAuthor' => null
        ];
    }

    /**
     * @param array $args
     *
     * @return \WP_User[]
     */
    protected function fetchRaw(array $args)
    {
        return $this->warp->get_users($args) ?: [];
    }

}