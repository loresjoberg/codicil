<?php

namespace LoreSjoberg\Codicil\Curators;

use LoreSjoberg\Codicil\Core\Curator;
use WP_Term;

/**
 * Class TermCurator
 * @package LoreSjoberg\Codicil\Curators
 */
abstract class TermCurator extends Curator
{

    /**
     * @param $id
     *
     * @return $this
     */
    public function hasPosts($id) {
        $this->setConstraint('hasPosts', $id);

        return $this;
    }

    final protected function getDefaultConstraints()
    {
        return [
            'limit' => '',
            'exclude' => [],
            'ids' => [],
            'offset' => '',
            'order' => [
                'by' => 'name',
                'direction' => 'ASC'
            ],
            'posts' => null,
            'taxonomy' => null,
            'hasPosts' => null
        ];
    }

    /**
     *
     * @return array
     */
    final protected function prepareCoreArgs()
    {
        // Excluding Uncategorized, which may go by another name but which is
        // Term ID 1
        $this->constraints['exclude'][] = 1;

        $args = [
            'number' => $this->constraints['limit'],
            'hide_empty' => false,
            'exclude' => $this->constraints['exclude'],
            'include' => $this->constraints['ids'],
            'fields' => 'all',
            'offset' => $this->constraints['offset'],
            'order' => strtoupper($this->constraints['order']['direction']),
            'orderby' => $this->constraints['order']['by'],
            'object_ids' => $this->constraints['hasPosts'],
            'taxonomy' => $this->constraints['taxonomy']
        ];

        return $args;
    }

    /**
     * @param array $args
     *
     * @return WP_Term[]
     */
    protected function fetchRaw(array $args)
    {
        return $this->warp->get_terms($args) ?: [];
    }

}