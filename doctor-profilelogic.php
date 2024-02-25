<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';
require 'auth/logged-in-user.php';

if ($loggedInUser) {
    $userId = $loggedInUser['Id'];

    if (isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Speciality']) && isset($_POST['ClinicAddress']) && isset($_POST['ContactNumber'])) {
        $newFirstName = $_POST['FirstName'];
        $newLastName = $_POST['LastName'];
        $speciality = $_POST['Speciality'];
        $clinicAddress = $_POST['ClinicAddress'];
        $contactNumber = $_POST['ContactNumber'];

        try {
            $userStmt = $conn->prepare("UPDATE User SET Name = :newFirstName, Surname = :newLastName WHERE Id = :userId");
            $userStmt->bindParam(":newFirstName", $newFirstName);
            $userStmt->bindParam(":newLastName", $newLastName);
            $userStmt->bindParam(":userId", $userId);
            $userStmt->execute();

            $doctorStmt = $conn->prepare("UPDATE Doctor SET speciality = :speciality, clinic_address = :clinicAddress, contact_number = :contactNumber WHERE user_id = :userId");
            $doctorStmt->bindParam(":speciality", $speciality);
            $doctorStmt->bindParam(":clinicAddress", $clinicAddress);
            $doctorStmt->bindParam(":contactNumber", $contactNumber);
            $doctorStmt->bindParam(":userId", $userId);
            $doctorStmt->execute();

            echo "Data updated successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "One or more fields are missing.";
    }
} else {
    echo "User is not logged in";
}
