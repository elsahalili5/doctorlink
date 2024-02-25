<?php
require './database/config.php';

// Check if the user ID is received
if (isset($_GET['id'])) {
    $apptId = $_GET['id'];
    echo "User ID received: $userId";
    try {
        $stmt = $conn->prepare("DELETE FROM Appointments WHERE id = :id");
        $stmt->bindParam(':id', $apptId);
        if ($stmt->execute()) {
            echo "Appt deleted successfully.";
            header("Location: view-appointmentss.php");
            exit();
        } else {
            echo "Failed to delete appt.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "User ID not received.";
}
