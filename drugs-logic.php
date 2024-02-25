<?php
include('./database/config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $drugName = $_POST['drugName'];
    $note = $_POST['note'];


    if (!empty($drugName)) {
        try {
            $sql = "INSERT INTO drugs (drug_name, note) 
                    VALUES (:drugName, :note)";

            $insertStmt = $conn->prepare($sql);

            $insertStmt->bindParam(':drugName', $drugName);
            $insertStmt->bindParam(':note', $note);

            $insertStmt->execute();

            header("Location: drugs.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Drug Name is required.";
    }
}
