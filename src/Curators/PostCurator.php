<?php

namespace LoreSjoberg\Codicil\Curators;

use LoreSjoberg\Codicil\Core\Curator;

abstract class PostCurator extends Curator
{

    final protected function prepareCoreArgs()
    {

        $this->constraints['order']['direction'] = strtoupper($this->constraints['order']['direction']);

        $args = array(
            'post_type' => $this->constraints['postType'],
            'posts_per_page' => $this->constraints['limit'],
            'post_status' => $this->constraints['status'],
            'post_parent' => $this->constraints['belongingTo'],
            'exclude' => $this->constraints['exclude'],
            'include' => $this->constraints['ids'],
            'order' => $this->constraints['order']['direction'],
            'orderby' => $this->constraints['order']['by'],
            'offset' => $this->constraints['offset'],
            'author__in' => $this->constraints['hasAuthors']
        );

        return $args;
    }

    public function hasStatus($value)
    {
        if ($value === 'published') {
            $value = 'publish';
        }

        return $this->setConstraint('status', $value);
    }

    /**
     * @param int[] $authorIds
     */
    public function hasAuthors(array $authorIds)
    {
        $this->setConstraint('hasAuthors', $authorIds);
    }

    final protected function getDefaultConstraints() {
        return [
            'limit' => -1,
            'belongingTo' => null,
            'exclude' => null,
            'ids' => null,
            'status' => 'publish',
            'order' => [
                'by' => 'date',
                'direction' => 'DESC'
            ],
            'offset' => 0,
            'postType' => 'any',
            'hasAuthors' => null
        ];
    }

    /**
     * @param array $args
     *
     * @return \WP_Post[]
     */
    final protected function fetchRaw(array $args)
    {
        return $this->warp->get_posts($args) ?: [];
    }

}