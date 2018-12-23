<?php

namespace MarkusGehrig\Diary\Bootstrap;

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

use MarkusGehrig\Diary\IO\Request;
use MarkusGehrig\Diary\IO\Response;
use MarkusGehrig\Diary\Database\DatabaseConnector;

use MarkusGehrig\Diary\Dispatcher\Dispatcher;

class bootstrap
{

    /*
     *
     */
    private $request = null;

    /*
     *
     */
    public function __construct()
    {
        // Load the configuration from the configuration file
        $GLOBALS['configuration']   = $this->getConfiguration();
        $GLOBALS['database']        = (new DatabaseConnector())->getConnection();

        //var_dump($GLOBALS['database']);
    }

    public function main()
    {
        // Get IO classes for request and responde
        $request = new Request();
        $response = new Response();

        $dispatcher = new Dispatcher();
        $html = $dispatcher->setController('Login')->dispatch();
    }
  
    /**
     * getConfiguration
     *
     * @return void
     */
    public function getConfiguration()
    {
        return (array) include 'configuration/Configuration.php';
    }
}
