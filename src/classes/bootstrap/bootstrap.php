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

use Symfony\Component\HttpFoundation\Request;

class Bootstrap {

    /* 
     *
     */
    private $Request = null;

    /* 
     *
     */
    public function __construct() {
        
        // Load the configuration from the configuration file
        $GLOBALS['configuration'] = $this->getConfiguration();

        // Load the request
        $GLOBALS['request'] = $this->getRequest();
    }

    /* 
     *
     */
    public function main() {
        echo("<pre>");
        print_r($GLOBALS['configuration']);
        print_r($GLOBALS['request']);
        echo("</pre>");
    }

    /* 
     *
     */
    public function getRequest() {
        return Request::createFromGlobals();
    }

    public function getConfiguration() {
        return include 'configuration/Configuration.php';
    }

}