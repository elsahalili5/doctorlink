<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';
require 'auth/logged-in-user.php';

if ($loggedInUser) {
    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['dateOfBirth'], $_POST['gender'], $_POST['address'], $_POST['contactNumber'], $_POST['medicalHistory'], $_POST['insuranceInfo'])) {
        $userId = $_SESSION['user']['Id'];
        $newFirstName = $_POST['firstName'];
        $newLastName = $_POST['lastName'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contactNumber = $_POST['contactNumber'];
        $medicalHistory = $_POST['medicalHistory'];
        $insuranceInfo = $_POST['insuranceInfo'];

        try {
            $userStmt = $conn->prepare("UPDATE User SET Name = :newFirstName, Surname = :newLastName WHERE Id = :userId");
            $userStmt->bindParam(":newFirstName", $newFirstName);
            $userStmt->bindParam(":newLastName", $newLastName);
            $userStmt->bindParam(":userId", $userId);
            $userStmt->execute();

            $patientStmt = $conn->prepare("UPDATE Patients SET date_of_birth = :dateOfBirth, gender = :gender, address = :address, contact_number = :contactNumber, medical_history = :medicalHistory, insurance_info = :insuranceInfo WHERE user_id = :userId");
            $patientStmt->bindParam(":dateOfBirth", $dateOfBirth);
            $patientStmt->bindParam(":gender", $gender);
            $patientStmt->bindParam(":address", $address);
            $patientStmt->bindParam(":contactNumber", $contactNumber);
            $patientStmt->bindParam(":medicalHistory", $medicalHistory);
            $patientStmt->bindParam(":insuranceInfo", $insuranceInfo);
            $patientStmt->bindParam(":userId", $userId);
            $patientStmt->execute();

            header('Location: profile.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "One or more fields are missing.";
    }
} else {
    echo "User is not logged in.";
}
