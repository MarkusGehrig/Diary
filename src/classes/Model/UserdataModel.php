<?php

namespace MarkusGehrig\Dairy\Model;

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

use \PDO;

class UserdataModel {
    private $id;
    private $password;
    private $surname;
    private $lastname;
    private $email;
    private $active;

    public function __construct($email = '', $password = '', $surname = '', $lastname = '', $active = false, $id = null) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->active = $active;
    }

    public function __destruct() {
        //$this->updateData();
    }

    /**
     * getter / setter Email
     */

    public function getId() {
        return $this->id;
    }


    /**
     * getter / setter Email
     */

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        $this->updateData();
        return $this;
    }

    /**
     * getter / setter Password
     */

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        $this->updateData();
        return $this;
    }

    /**
     * getter / setter Surname
     */

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
        $this->updateData();
        return $this;
    }

    /**
     * getter / setter Lastname
     */

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        $this->updateData();
        return $this;
    }

    /**
     * getter / setter Active
     */

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
        $this->updateData();
        return $this;
    }

    /**
     * getter / setter Database
     */

    public function getData(int $id) {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $data = $queryBuilder->select('id', 'email', 'password', 'surname', 'lastname', 'active')
            ->from('userdata')
            ->where('id = ?')
            ->setParameter(0, $queryBuilder->createNamedParameter($id))
            ->execute()
            ->fetch();

        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->surname = $data['surname'];
        $this->lastname = $data['lastname'];
        $this->active = $data['active'];
    }

    public function getDataByEmail($email = '') {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $data = $queryBuilder->select('id', 'email', 'password', 'surname', 'lastname', 'active')
            ->from('userdata')
            ->where('email = ?','active = ?')
            ->setParameter(0, $queryBuilder->createNamedParameter($email))
            ->setParameter(1, true)
            ->execute()
            ->fetch();

        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->surname = $data['surname'];
        $this->lastname = $data['lastname'];
        $this->active = $data['active'];
    }

    public function createData() {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $GLOBALS['database']->insert(
            'userdata',
            [
                'email' =>      $this->getEmail(),
                'password' =>   $this->getPassword(),
                'surname' =>    $this->getSurname(),
                'lastname' =>   $this->getLastname(),
                'active' =>     $this->getActive()
            ],
            [
                PDO::PARAM_STR,
                PDO::PARAM_STR,
                PDO::PARAM_STR,
                PDO::PARAM_STR,
                PDO::PARAM_BOOL
            ]
        );
        
        $this->id = $GLOBALS['database']->lastInsertId();
    }

    public function updateData() {
        if($this->uid == null) {
            $this->createData();
        }
        else {
            $queryBuilder = $GLOBALS['database']->createQueryBuilder();
            $GLOBALS['database']->update(
                'userdata',
                [
                    'email' =>      $queryBuilder->createNamedParameter($this->getEmail()),
                    'password' =>   $this->getPassword(),
                    'surname' =>    $queryBuilder->createNamedParameter($this->getSurname()),
                    'lastname' =>   $queryBuilder->createNamedParameter($this->getLastname()),
                    'active' =>     $this->getActive()
                ],
                [
                    'id' => $this->getId()
                ],
                [
                    PDO::PARAM_STR,
                    PDO::PARAM_STR,
                    PDO::PARAM_STR,
                    PDO::PARAM_STR,
                    PDO::PARAM_BOOL
                ]
            );    
        }
    }
}