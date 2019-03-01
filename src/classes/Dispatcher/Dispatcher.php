<?php

namespace MarkusGehrig\Diary\Dispatcher;

// Copyright (c) 2018 Markus Gehrig
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

use MarkusGehrig\Diary\Controller\LoginController;
use MarkusGehrig\Diary\Session\Session;
use \Exception;

class Dispatcher
{
    private $controller = "";
    private $action = "";
    private $request = [];
    private $query  = [];
    private $controllerValue = [];

    public function __construct()
    {
        $this->request = $GLOBALS['request']->getRequestParameter('request');
        $this->query   = $GLOBALS['request']->getRequestParameter('query');
        
        $this->controllerValue = array_merge((array) $this->controllerValue, (array) $this->request->get('Controller'));
        $this->controllerValue = array_merge((array) $this->controllerValue, (array) $this->query->get('Controller'));
    }

    public function setController()
    {
        if (isset($this->controllerValue['name'])) {
            $this->controller = $this->controllerValue['name'];
        } else {
            if ($this->checkAuthentication()) {
                $this->controller = "Dashboard";
            }
            else {
                $this->controller = "Login";
            }
        }
        
        return $this;
    }

    public function setAction()
    {
        if (isset($this->controllerValue['action'])) {
            $this->action = $this->controllerValue['action'] . "Action";
        } else {
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
            if (method_exists($class, $this->action)) {
                $action = $this->action;

                $class->setValue($this->controllerValue);
                return $class->$action();
            } else {
                return $class->setValue($this->controllerValue)->run();
            }
        } else {
            return $class->setValue($this->controllerValue)->run();
        }
    }

    public function redirect($controller, $action = null, $controllerValue = null)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->controllerValue = $controllerValue;

        return $this->dispatch();
    }

    private function checkAuthentication()
    {
        if ($GLOBALS['session']->getValue('login')) {
            return (boolean) true;
        };
        return (boolean) false;
        
    }

    private function getControllerClass()
    {
        return (string) 'MarkusGehrig\\Diary\\Controller\\' . $this->controller . 'Controller';
    }
}
