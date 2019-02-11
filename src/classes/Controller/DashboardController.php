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

use MarkusGehrig\Diary\Controller\AbstractViewController;
use MarkusGehrig\Dairy\Model\RecordModel;

class DashboardController extends AbstractViewController
{
    private $userId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->userId = $GLOBALS['session']->getValue('userId');
    }

    public function show()
    {
        $RecordModels = (new RecordModel())->getDataByUser($this->userId);

        $items = [];
        foreach ($RecordModels as $RecordModel) {
            $array['title'] = (string) $RecordModel->getTitle();
            $array['date'] = (int) $RecordModel->getDate();
            $array['text'] = (string) $RecordModel->getText();

            $items[] = $array;
        }

        return $this->render(array('items' => $items));
    }

    public function createAction() {
        $request = $this->getControllerRequest();
        // var_dump();
        //["title"]=> string(0) "" ["date"]=> string(0) "" ["text"]=> string(2271)

        $RecordModel = new RecordModel((string) $request['title'], (string) $request['text'], (int) $request['date'], null, (int) $this->userId);
        var_dump($RecordModel);

        $RecordModel->createData();
        return $this->show();
    }

    public function modifyAction() {

    }

    public function removeAction() {

    }
}
