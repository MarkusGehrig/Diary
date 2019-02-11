<?php

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

namespace MarkusGehrig\Diary\IO;

class Response
{
    private $response;

    public function __construct()
    {
        $this->response = new \Symfony\Component\HttpFoundation\Response();
    }

    public function send()
    {
        $this->setSslHeader();
        $this->setDefaultHeaders();
        $this->response->send();
    }

    public function setContent(string $content = "No Content")
    {
        $this->response->setContent($content);
        return $this;
    }

    public function setStatusCode(string $code = \Symfony\Component\HttpFoundation\Response::HTTP_OK)
    {
        $this->response->setStatusCode($code);
        return $this;
    }

    public function setHttpResponseHeader(string $type = 'text/html')
    {
        $this->response->headers->set('Content-Type', $type);
        return $this;
    }

    private function setDefaultHeaders()
    {
        //$this->response->headers->set('Content-Security-Policy', "default-src 'self' *.google.com");
        $this->response->setCharset('utf-8');
    }

    private function setSslHeader()
    {
        if ($GLOBALS['configuration']['ssl']) {
            $this->response->headers->set('Strict-Transport-Security', 'max-age=31536000');
        }
    }
}
