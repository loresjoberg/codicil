<?php

namespace LoreSjoberg\Codicil\Curators;


/**
 * Class AuthorCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class AuthorCurator extends UserCurator
{

    protected $defaults = [
        'isAuthor' => true,
        'ofPosts' => []
    ];

    public function ofPosts(array $postIds)
    {
        $this->setConstraint('ofPosts', $postIds);
    }

    protected function prepareArgs($args)
    {
        foreach ($this->constraints['ofPosts'] as $postId) {
            $this->constraints['ids'][] = $this->warp->get_post_field('post_author', $postId);
        }

        $args['include'] = $this->constraints['ids'];

        return $args;
    }
}

