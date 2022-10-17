<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=mariadb_dev;charset=utf8', 'root', 'sprit_dev');
    return $db;
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
