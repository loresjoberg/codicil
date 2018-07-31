<?php
/**
 * Created by PhpStorm.
 * User: loresjoberg
 * Date: 7/30/18
 * Time: 10:56 AM
 */

namespace LoreSjoberg\Codicil\Core;


use LoreSjoberg\Codicil\Curators\AuthorCurator;
use LoreSjoberg\Codicil\Curators\BlogPostCurator;
use LoreSjoberg\Codicil\Curators\CategoryCurator;
use LoreSjoberg\Codicil\Curators\PageCurator;
use LoreSjoberg\Codicil\Curators\UserCurator;
use LoreSjoberg\Warp\Warp;

class Codicil
{
    static public function query($curator = null) {
        $warp = new Warp();
        $curators = [
            'users' => new UserCurator($warp),
            'authors' => new AuthorCurator($warp),
            'blogPosts' => new BlogPostCurator($warp),
            'categories' => new CategoryCurator($warp),
            'pages' => new PageCurator($warp),
        ];

        $queryContainer = new QueryContainer($curators);

        if ($curator) {
            return $queryContainer->select($curator);
        }

        return $queryContainer;
    }
}