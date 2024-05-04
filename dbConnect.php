<?php
session_start();
require_once "dbConfig.php";
try {
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$db_name", $user, $pwd);
} catch (PDOException $e) {
    die("Couldn't connect to the database $db_name: ".$e->getMessage());
}
?>