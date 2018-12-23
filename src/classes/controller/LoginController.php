<?php

namespace MarkusGehrig\Diary\Controller;

use MarkusGehrig\Diary\Controller\AbstractViewController;

class LoginController extends AbstractViewController
{
    private $needAuthentication = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $this->render(null);
    }
}
