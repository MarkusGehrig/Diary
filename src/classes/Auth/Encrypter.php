<?php

namespace MarkusGehrig\Diary\Auth;

class Encrypter {


    public function __construct() {
    }

    public function encrypt($password) {
        $algo = $GLOBALS['configuration']['password']['algo'];

        $options = [
            'cost' => 12,
        ];

        return (string) password_hash($password, $algo, $options);
    }

    public function verify($password, $hash) {
        return (bool) password_verify();
    }
}