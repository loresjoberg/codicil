<?php


namespace LoreSjoberg\Codicil\Curators;

/**
 * Class PageCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class PageCurator extends PostCurator
{

    protected $defaults = [
        'postType' => 'page'
    ];

}