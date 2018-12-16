<?php

namespace MarkusGehrig\Diary\Controller;

use MarkusGehrig\Diary\Controller\AbstractController;

class LoginController extends AbstractController
{
    private $needAuthentication = false;

    public function __construct()
    {

    }

    public function show()
    {
        echo('Sie müssen sich einloggen');
    }
}
