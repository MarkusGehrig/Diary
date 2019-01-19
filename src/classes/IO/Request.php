<?php

namespace MarkusGehrig\Diary\IO;

class Request
{
    private $request = [];

    public function __construct()
    {
        // Load the request
        $this->request = $this->getSymfonyRequest();
        $GLOBALS['request'] = $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getRequestParameter($name)
    {
        if (key_exists($name, $this->request)) {
            return $this->request[$name];
        } else {
            throw new \Exception("Request parameter does not exists.", 1000);
        }
    }

    /**
     * getRequest
     *
     * @return void
     */
    private function getSymfonyRequest()
    {
        return (array) \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
}
