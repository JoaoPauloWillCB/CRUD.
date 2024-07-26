<?php

use App\Classes\Alert;

define('APP_CRUDPHP', array('HOSTNAME' => 'localhost', 'DBNAME' => 'crud_portifolio', 'USERNAME' => 'root', 'PASSWORD' => ''));

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dns = 'mysql:host=' . APP_CRUDPHP['HOSTNAME'] . ';dbname=' . APP_CRUDPHP['DBNAME'] . ';charset=utf8mb4';

try {
    
    $pdo = new PDO($dns, APP_CRUDPHP['USERNAME'], APP_CRUDPHP['PASSWORD'], $options);

} catch (PDOException $e) {
    
    Alert::setError($e->getMessage());

    header("Location: /login");
    
    exit; 
    
}