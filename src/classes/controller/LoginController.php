<?php

namespace MarkusGehrig\Diary\Controller;

use MarkusGehrig\Diary\Controller\AbstractViewController;
use MarkusGehrig\Diary\Auth\Authentication;

class LoginController extends AbstractViewController
{
    private $needAuthentication = false;

    public function __construct()
    {
        parent::__construct("cache/twig");
        
    }

    public function show()
    {
        return $this->render(null);
    }

    public function loginAction() {
        $authentication = new Authentication();

        $request = $this->getControllerRequest();
        $username = $request['useremail'];
        $password = $request['userpassword'];

        if($authentication->verify($username, $password)) {
            return $GLOBALS['dispatcher']->redirect("Dashboard");
        }
        else {
            return $this->render(array('error' => true));
        }
    }
}
