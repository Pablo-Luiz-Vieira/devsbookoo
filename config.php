<?php
session_start();

$base = 'http://localhost/devsbookoo';
$db_name = 'devsbookoo';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$maxWidth = 800;
$maxHeight = 800;

$pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
