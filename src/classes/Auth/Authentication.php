<?php

namespace MarkusGehrig\Diary\Auth;

use MarkusGehrig\Diary\Auth\Encrypter;

class Authentication {
    private $encrypter = null;

    public function __construct() {
        $encrypter = new Encrypter();
    }

    public function verify($user, $password) {

    }

    private function getUser($user) {
        
    }
}