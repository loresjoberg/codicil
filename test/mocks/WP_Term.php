<?php

class WP_Term
{
    public $term_id = 1;
    public $name = 'Fake Category';
    public $slug = 'fake-category';
    public $term_group = 'fakes';
    public $term_taxonomy_id = 2;
    public $taxonomy = 'fake_terms';
    public $description = 'This is a fake category';
    public $parent = 3;
    public $count = 10;

     public function __construct($fakeTerm = null) {
             if ($fakeTerm) {
                         $this->term_id = $fakeTerm->term_id;
             }
      }
}