<?php

namespace MarkusGehrig\Diary\Dispatcher;

use MarkusGehrig\Diary\Controller\LoginController;

class Dispatcher
{
    private $controller = "";
    private $action = "";
    private $request = [];
    private $controllerValue = [];

    public function __construct()
    {   
        $this->request = $GLOBALS['request']->getRequestParameter('request');    
    }

    public function setController()
    {   
        $this->controllerValue = $this->request->get('Controller');
        if(isset($this->controllerValue['name'])) {
            $this->controller = $this->controllerValue['name'];      
        }
        else {
            $this->controller = "Login";
        }
        
        return $this;
    }

    public function setAction() {
        $this->controllerValue = $this->request->get('Controller');
        if(isset($this->controllerValue['action'])) {
            $this->action = $this->controllerValue['action'] . "Action";    
        }
        else{
            $this->action = null;
        }
     
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
            // Call fix the Login controller for security
            $class = new LoginController();
        }
        
        // Check if Authentication is required
        if ($class->getNeedAuthentication()) {
            // Check if user is logged in.
            if (!$this->checkAuthentication()) {
                // Call fix the Login controller for security
                $class = new LoginController();
            }
        }

        // Check if the Action is set and if the specified methode exists
        if ($this->action !== null) {
            if(method_exists($class, $this->action)) {
                $action = $this->action;

                $class->setValue($this->controllerValue);
                return $class->$action();
            }

            else {
                return $class->setValue($this->controllerValue)->run();
            }
        }
        else {
            return $class->setValue($this->controllerValue)->run();
        }
    }

    public function redirect($controller, $action = null, $controllerValue = null) {
        $this->controller = $controller;
        $this->action = $action;
        $this->controllerValue = $controllerValue;

        return $this->dispatch();
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
