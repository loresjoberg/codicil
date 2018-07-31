<?php


namespace LoreSjoberg\Codicil\Curators;


/**
 * Class BlogPostCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class BlogPostCurator extends PostCurator
{
    protected $defaults = [
        'postType' => 'post',
        'hasCategories' => ''
    ];

    /**
     * @param int[] $array
     */
    public function hasCategories(array $array) {
        $this->setConstraint('hasCategories', $array);
    }

    public function prepareArgs($args)
    {
        if ($this->constraints['hasCategories']) {
            $categories       = implode(',', $this->constraints['hasCategories']);
            $args['category'] = $categories;
        }

        return $args;
    }

}