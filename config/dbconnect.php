<?php
include_once "../libs/dibi/src/loader.php";
dibi::connect([
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'username' => '',
    'password' => '',
    'database' => '',
    'charset'  => 'utf8',
]);