<?php

namespace MarkusGehrig\Diary\Database;

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
