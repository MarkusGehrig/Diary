<?php

namespace MarkusGehrig\Diary\Dispatcher;

use MarkusGehrig\Diary\Controller\LoginController;

class Dispatcher
{
    private $controller = "";

    public function __construct()
    {
    }

    public function setController(string $controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function dispatch()
    {
        // Get the classname and create an instance
        $classname = $this->getControllerClass();

        // Check if class exists
        if (class_exists($classname)) {
            $class = new $classname;
        } else {
            $class = new LoginController();
        }
        
        // Check if Authentication is required
        if ($class->getNeedAuthentication()) {
            // Check if user is logged in.
            if (!$this->checkAuthentication()) {
                $class = new LoginController();
            }
        }

        return $class->show();
    }

    private function checkAuthentication()
    {
        return (boolean) true;
    }

    private function getControllerClass()
    {
        return (string) 'MarkusGehrig\\Diary\\Controller\\' . $this->controller . 'Controller';
    }
}
