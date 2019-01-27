<?php

namespace MarkusGehrig\Diary\Auth;

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

use MarkusGehrig\Diary\Auth\Encrypter;
use MarkusGehrig\Dairy\Model\UserdataModel;

class Authentication
{
    private $encrypter = null;

    public function __construct()
    {
        $this->encrypter = new Encrypter();
    }

    public function verify($user, $password)
    {
        if (isset($user) == false && isset($password) == false) {
            return false;
        }

        //var_dump($user);
        $user = (new UserdataModel())->getDataByEmail($user);
        //var_dump($user);
        
        
        if ($this->encrypter->verify($password, $user->getPassword())) {
            $GLOBALS['session']->setValue('login', true);
            return true;
        }
        return false; 
    }

    private function getUser($user)
    {
    }
}
