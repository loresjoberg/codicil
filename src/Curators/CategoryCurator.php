<?php

namespace LoreSjoberg\Codicil\Curators;

/**
 * Class CategoryCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class CategoryCurator extends TermCurator
{

    protected $defaults = [
        'taxonomy' => 'category'
    ];

}