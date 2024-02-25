<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';


// Selected patient
$patientId = $_POST['patientID'];
$dateAndTime = date("d/m/Y h:i");

$dateTime = DateTime::createFromFormat('d/m/Y H:i', $dateAndTime);
$formattedDateTime = $dateTime->format('Y-m-d H:i:s');

// Drug data from form
$drugTypes = $_POST['drugType'];
$drugIds = $_POST['drugId'];
$miligrams = $_POST['mgMl'];
$doses = $_POST['dose'];
$durations = $_POST['duration'];
$advices = $_POST['advice'];

try {
    // insert new perscription
    $prescriptionSql = "INSERT INTO Prescriptions (patient_id, prescription_date) VALUES (:patientId, :dateAndTime)";
    $stmt = $conn->prepare($prescriptionSql);
    $stmt->bindParam(":patientId", $patientId);
    $stmt->bindParam(":dateAndTime", $formattedDateTime);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$prescriptionId = $conn->lastInsertId();



// add perscription drugs details
for ($i = 0; $i < count($drugIds); $i++) {
    $drugType = $drugTypes[$i];
    $drugId = $drugIds[$i];
    $mgMl = $miligrams[$i];
    $dose = $doses[$i];
    $duration = $durations[$i];
    $advice = $advices[$i];

    // echo "Row " . ($i + 1) . " - Drug Type: $drugType, Drug id: $drugId, mg/ml: $mgMl, Dose: $dose, Duration: $duration, Advice: $advice <br>";

    try {
        $prescriptionDrugsSql = "
        INSERT INTO Prescription_drugs (prescription_id, drug_id, drugType, mg_ml, dose, duration, advice) 
        VALUES (:prescriptionId, :drugId, :drugType, :mg_ml, :dose, :duration, :advice)";

        $prescriptionDrugsStmt = $conn->prepare($prescriptionDrugsSql);

        $prescriptionDrugsStmt->bindParam(":prescriptionId", $prescriptionId);
        $prescriptionDrugsStmt->bindParam(":drugId", $drugId);
        $prescriptionDrugsStmt->bindParam(":drugType", $drugType);
        $prescriptionDrugsStmt->bindParam(":mg_ml", $mgMl);
        $prescriptionDrugsStmt->bindParam(":dose", $dose);
        $prescriptionDrugsStmt->bindParam(":duration", $duration);
        $prescriptionDrugsStmt->bindParam(":advice", $advice);

        $prescriptionDrugsStmt->execute();

        header('location: prescriptions.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
