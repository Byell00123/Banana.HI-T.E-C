<?php
// models/database.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Banana.Hi-T.E-C/src/config.php';

function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
