<?php
$host = "localhost";
$password = "";
$user = "root";
$dbname = "doctorlink";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Connection failed: " . $e->getMessage();
    die();
}
