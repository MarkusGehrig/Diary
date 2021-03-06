<?php

namespace MarkusGehrig\Diary\Database;

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

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class DatabaseConnector
{
    private $connection = null;

    private $config = [];

    public function __construct()
    {
        $this->config = $this->getDatabaseCredentialsFromConfiguration();
        $this->connection = $this->getDbalConnection();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function getDatabaseCredentialsFromConfiguration()
    {
        return $GLOBALS['configuration']['database'];
    }

    private function getDbalConnection()
    {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' =>     $this->config['database'],
            'user' =>       $this->config['user'],
            'password' =>   $this->config['password'],
            'host' =>       $this->config['server'],
            'driver' =>     $this->config['driver'],
        );
        return DriverManager::getConnection($connectionParams, $config);
    }
}
