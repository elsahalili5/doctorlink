<?php
require './database/config.php';

if (isset($_GET['id'])) {
    $drugId = $_GET['id'];
    echo "Drug ID received: $drugId";
    try {
        $stmt = $conn->prepare("DELETE FROM Drugs WHERE id = :id");
        $stmt->bindParam(':id', $drugId);
        if ($stmt->execute()) {
            echo "Drug deleted successfully.";
            header("Location: drugs.php");
            exit();
        } else {
            echo "Failed to delete drug.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Drug ID not received.";
}
