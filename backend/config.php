<?php

$dsn = "mysql:host=localhost;dbname=react";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    // echo 'this database is connection';
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}