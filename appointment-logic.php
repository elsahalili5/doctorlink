<?php
include('./database/config.php');

session_start();
require 'database/config.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dob = $_POST['dob'];
$phoneNumber = $_POST['phoneNumber'];
$address = $_POST['address'];
$email = $_POST['email'];
$previousVisit = $_POST['previousVisit'];
$doctorId = $_POST['doctor'];
$appointmentProcedure = $_POST['appointmentProcedure'];
$preferredDate = $_POST['preferredDate'];
$preferredTime = $_POST['preferredTime'];

try {
    $stmt = $conn->prepare("
        INSERT INTO appointments (firstName, lastName, dob, phoneNumber, address, email, previousVisit, doctorId, appointmentProcedure, preferredDate, preferredTime)
        VALUES (:firstName, :lastName, :dob, :phoneNumber, :address, :email, :previousVisit, :doctorId,:appointmentProcedure, :preferredDate, :preferredTime)
    ");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':previousVisit', $previousVisit);
    $stmt->bindParam(':doctorId', $doctorId);
    $stmt->bindParam(':appointmentProcedure', $appointmentProcedure);
    $stmt->bindParam(':preferredDate', $preferredDate);
    $stmt->bindParam(':preferredTime', $preferredTime);

    $stmt->execute();

    header('Location: view-appointmentss.php');
    exit();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
