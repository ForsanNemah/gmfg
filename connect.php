<?php
$database = 'mysql:host=localhost;dbname=u122541238_efg';
$user     = 'u122541238_efg_root';
$pass     = 'Forsan@2023';
$option   = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',);
try {
    $con = new PDO($database, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    include 'function.php';
} catch (PDOException $error) {
    echo 'Failed To Connect ' . $error->getMessage();
}
