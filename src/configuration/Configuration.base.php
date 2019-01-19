<?php

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

// Main Configuration
// This file configures the hole static part of the website
return [
    'domain' => '',

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
        'driver'   => 'pdo_mysql'
    ],

    'password' => [
        'algo'  => PASSWORD_BCRYPT,
    ],

    'mail'  => [
        'server' => 'XYZ.com',
        'user' => 'XYZ',
        'password' => 'XYZ'
    ],

    // Is SSL active or not
    'ssl'      => false
];
