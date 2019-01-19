<?php

namespace MarkusGehrig\Diary\Controller;

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

use \DateTime;
use MarkusGehrig\Diary\Controller\AbstractViewController;
use MarkusGehrig\Diary\Mail\MailSender;
use MarkusGehrig\Dairy\Model\UserdataModel;
use MarkusGehrig\Dairy\Model\RegistrationModel;
use MarkusGehrig\Diary\Auth\Encrypter;

class RegistrationController extends AbstractViewController
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

    public function verfiyAction()
    {  
        return $GLOBALS['dispatcher']->redirect("Login");
    }

    public function registerAction()
    {
        $request = $this->getControllerRequest();

        //var_dump($request);

        if( isset($request["usersurname"]) === true && 
            isset($request["useremail"]) === true && 
            isset($request["userlastname"]) === true &&
            isset($request["userpassword"]) === true ) {
            
            if(filter_var($request["useremail"], FILTER_VALIDATE_EMAIL)) {

                try {
                    $encrypter = new Encrypter();
                    $password = $encrypter->encrypt($request["userpassword"]);
                    $verifykey = md5(serialize($request));
                
                    $user = new UserdataModel($request["useremail"], $password, $request["usersurname"], $request["userlastname"]);
                    $user->createData();

                    $date = new DateTime();
                    $registration = new RegistrationModel($user, $date->getTimestamp(), $verifykey);
                    $registration->createData();

                    // Sendmail
                    $mailSender = new MailSender();
                    
                    $message = $mailSender->createMail('Test', 'no-reply@photograph.photography', 'markus.gehrig96@gmail.com', $this->createMail($request["usersurname"], $request["userlastname"], $verifykey));
                    $mailSender->send($message);

                    return $GLOBALS['dispatcher']->redirect("Login");
                } catch (\Throwable $th) {
                    return $this->render(array('error' => true, 'message' => 'Server error in registration'));
                }
            }
        }

        return $this->render(array('error' => true, 'message' => 'Please fill out all fields'));
    }

    private function createMail($firstname, $lastname, $verifykey) {
        return '<p>Hello ' . $firstname . ' ' . $lastname . '</p>' .
            '<p>You are just a step away from activate your account, please verify your email with the follow link.</p>' .
            '<p><a href="'.$this->getActivationLink($verifykey).'">'.$this->getActivationLink($verifykey).'</a></p>';
    }

    private function getActivationLink() {
        return $GLOBALS['configuration']['domain'] . '/index.php?Controller[name]=Registration&Controller[action]=verfiy&Controller[verifykey]='. $verifykey;
    }
}