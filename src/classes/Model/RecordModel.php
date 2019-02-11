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

class RecordModel {
    private $id;
    private $title;
    private $text;
    private $date;
    private $userdata;

    public function __construct($title = '', $text = '', $date = 0, $id = null, $userdata = null) {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
        $this->date = $date;
        $this->userdata = $userdata;
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

    /** *
     * getter / setter Text 
     */

    public function setText($text) {
        $this->text = $text;
        $this->updateData();
        return $this;
    }

    public function getText(){
        return $this->text;
    }

    /**
     * getter / setter Title
     */
    public function setTitle($title) {
        $this->title = $title;
        $this->updateData();
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }
    
    /**
     * getter / setter Data
     */

    public function setDate($date) {
        $this->date = $date;
        $this->updateData();
        return $this;
    }

    public function getDate() {
        return $this->date;
    }
    
    /**
     * getter / setter userdata
     */

    public function setUserdata($userdata) {
        $this->userdata = $userdata;
        $this->updateData();
        return $this;
    }
    
    public function getUserdata() {
        return $this->userdata;
    }
    
    /**
     * getter / setter Database
     */

    public function getData(int $id) {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $data = $queryBuilder->select('id', 'title', 'date', 'text', 'Userdata_id')
            ->from('dairyitem')
            ->where('id = ' . $queryBuilder->createNamedParameter($id))
            ->execute()
            ->fetch();

        $returnData = [];
        foreach ($data as $item) {
            $returnData[] = new RecordModel(
                $item['title'],
                $item['text'],
                $item['date'],
                $item['id'],
                $item['Userdata_id']
            );
        }

        return $returnData;
    }

    public function getDataByUser(int $id) {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $data = $queryBuilder->select('id', 'title', 'date', 'text', 'Userdata_id')
            ->from('dairyitem')
            ->where('Userdata_id = ' . $queryBuilder->createNamedParameter($id))
            ->execute()
            ->fetchAll();

        $returnData = [];
        foreach ($data as $item) {
            $returnData[] = new RecordModel(
                $item['title'],
                $item['text'],
                $item['date'],
                $item['id'],
                $item['Userdata_id']
            );
        }

        return $returnData;
    }

    public function createData() {
        $queryBuilder = $GLOBALS['database']->createQueryBuilder();
        $GLOBALS['database']->insert(
            'dairyitem',
            [
                'title' =>          $this->getTitle(),
                'text' =>           $this->getText(),
                'date' =>           $this->getDate(),
                'Userdata_id' =>    $this->getUserdata()
            ],
            [
                PDO::PARAM_STR,
                PDO::PARAM_STR,
                PDO::PARAM_INT,
                PDO::PARAM_INT
            ]
        );
        
        $this->id = $GLOBALS['database']->lastInsertId();
    }

    public function updateData() {
        if($this->id == null) {
            $this->createData();
        }
        else {
            $queryBuilder = $GLOBALS['database']->createQueryBuilder();
            $GLOBALS['database']->update(
                'userdata',
                [
                    'title' =>          $this->getTitle(),
                    'text' =>           $this->getText(),
                    'date' =>           $this->getDate(),
                    'Userdata_id' =>    $this->getUserdata()
                ],
                [
                    'id' => $this->getId()
                ],
                [
                    PDO::PARAM_STR,
                    PDO::PARAM_STR,
                    PDO::PARAM_INT,
                    PDO::PARAM_INT
                ]
            );    
        }
    }
}