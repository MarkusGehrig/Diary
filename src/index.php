<?php

include_once __DIR__.'/vendor/autoload.php';

$GLOBALS['configuration'] = include __DIR__.'/configuration/Configuration.php';

print_r($GLOBALS['configuration']);
