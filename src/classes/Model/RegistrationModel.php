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

class RegistrationModel {

    private $id;
    private $userdata;
    private $date;
    private $verifykey;

    public function __construct($userdata = null, $date = 0, $verifykey = "", $id = null) {
        $this->id = $id;
        $this->userdata = $userdata;
        $this->date = $date;
        $this->verifykey = $verifykey;
    }

    public function __destruct() {
        //$this->updateData();
    }

    /**
     * Getter / Setter Uid
     */

    public function getId() {
        return $this->id;
    }

    /**
     * Getter / Setter Date
     */

    public function setDate(Datetime $date) {
        $this->date = $date;
        $this->updateData();
        return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function getVerifykey() {
        return $this->verifykey;
    }

    public function getUserdata() {
        return $this->userdata;
    }

    /**
     * Getter / Setter Database
     */

    public function getData(int $id) {

    }

    public function getDataByVerifykey($verifykey = "") {
        
    }

    public function createData() {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        var_dump($this->userdata->getId());
        $GLOBALS['database']->insert(
            'registration',
            [
                'verifykey' =>      $this->verifykey,
                'date' =>           $this->date,
                'Userdata_id' =>    $this->userdata->getId()
            ],
            [
                PDO::PARAM_STR,
                PDO::PARAM_INT,
                PDO::PARAM_INT
            ]
        );
        
        $this->id = $GLOBALS['database']->lastInsertId();
    }

    public function updateData() {
        if($this->uid !== null) {
            $this->createData();
        }
        else {

        }
    }
}