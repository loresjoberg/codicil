<?php

class WP_Post
{
    public $ID = 1;
    public $post_author = '2';
    public $post_name = 'fake-post';
    public $post_type = 'page';
    public $post_title = 'Fake Post';
    public $post_date = '2010-01-01 01:00:00';
    public $post_date_gmt = '2010-01-02 01:00:00';
    public $post_content = 'This is fake content.';
    public $post_excerpt = 'Fake excerpt';
    public $post_status = 'publish';
    public $comment_status = 'closed';
    public $ping_status = 'open';
    public $post_password = 'post/password';
    public $post_parent = 5;
    public $post_modified = '2010-01-03 01:00:00';
    public $post_modified_gmt = '2010-01-04 01:00:00';
    public $comment_count = '0';
    public $menu_order = '0';
    public $post_category = [9];

     public function __construct($fakePost) {
            $this->ID = $fakePost->ID;
     }
}