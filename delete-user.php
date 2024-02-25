<?php
require './database/config.php';

// Check if the user ID is received
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    echo "User ID received: $userId";
    try {
        $stmt = $conn->prepare("DELETE FROM User WHERE Id = :id");
        $stmt->bindParam(':id', $userId);
        if ($stmt->execute()) {
            echo "User deleted successfully.";
            header("Location: users.php");
            exit();
        } else {
            echo "Failed to delete user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "User ID not received.";
}
