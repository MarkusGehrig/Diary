<?php

namespace MarkusGehrig\Diary\Database;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class DatabaseConnector {

    private $connection = null;

    public function __construct() {
        $this->connection = $this->getDbalConnection;
    } 
    // TODO geht parameters from Globals
    private function getDbalConnection() {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => 'mydb',
            'user' => 'user',
            'password' => 'secret',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        return DriverManager::getConnection($connectionParams, $config);
    }   
}