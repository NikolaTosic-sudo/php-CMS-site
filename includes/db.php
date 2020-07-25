<?php ob_start();

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_name'] = 'cms';
$db['db_password'] = '';

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


