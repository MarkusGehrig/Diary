<?php

// Main Configuration
// This file configures the hole static part of the website
return [
    // Database Configuration
    'database' => [

        // Server URL, IP, DNS-Name
        'server'   => 'db',

        // Database user
        'user'     => 'root',

        // Database password
        'password' => 'geheim',

        // Database name
        'database' => 'dairy',

        // Driver (which type of database is used)
        // Allowed values are pdo_mysql, ibm_db2, pdo_sqlsrv, pdo_pgsql, pdo_sqlite
        'driver' => 'pdo_mysql',
    ],
];
