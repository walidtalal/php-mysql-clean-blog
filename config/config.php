<?php

// Host
define("HOST", 'localhost');

// DB name
define("DBNAME", "cleanblog");

// User
define("USER", "root");

// Password
define("PASS", "");

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
