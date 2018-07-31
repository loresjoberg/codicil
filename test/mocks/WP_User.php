<?php

class WP_User
{
    public $ID = 1;
    public $caps = [];
    public $cap_key = 'fake-category';
    public $roles = ['author'];
    public $allcaps = [];
    public $first_name = 'Alpha';
    public $last_name = 'Omega';
    public $user = 3;
    public $count = 10;
    public $user_login = 'fake-user';
    public $user_pass = 'hashed_password';
    public $user_nicename = 'fake-user';
    public $user_email = 'fakeuser@example.com';
    public $user_url;
    public $user_registered;
    public $user_activation_key;
    public $user_status;
    public $display_name = 'Alpha Omega';
    public $spam;
    public $deleted;

    public function __construct($id = 1) {
            $this->ID = $id;
    }


}