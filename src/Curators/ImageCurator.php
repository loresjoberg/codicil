<?php


namespace LoreSjoberg\Codicil\Curators;


/**
 * Class PageCurator
 * @package LoreSjoberg\Codicil\Curators
 *
 */
class ImageCurator extends PostCurator
{

    protected $defaults = [
        'postType' => 'attachment',
        'postMimeType' => 'image',
        'status' => 'inherit'
    ];

}