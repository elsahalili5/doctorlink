<?php
require "./database/config.php"; // Make sure this file contains the database connection ($conn)

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    // Retrieve form data
    $name = $_POST["inputFirstName"];
    $surname = $_POST["inputLastName"];
    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];
    $passwordConfirm = $_POST["inputPasswordConfirm"];
    $userType = $_POST["userType"];

    if ($password === $passwordConfirm) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO User (Name, Surname, Username, Password, Email, UserType) 
                    VALUES (:name, :surname, :username, :password, :email, :userType)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":surname", $surname);
            $stmt->bindParam(":username", $email);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":userType", $userType);
            $stmt->execute();

            $createdUserId = $conn->lastInsertId();



            if ($userType === 'Patient') {
                $patientSql = "INSERT INTO Patients (user_id) VALUES (:userId)";
                $patentStmt = $conn->prepare($patientSql);

                $patentStmt->bindParam(':userId', $createdUserId);
                $patentStmt->execute();
            } else if ($userType === 'Doctor') {
                $doctorSql = "INSERT INTO Doctor (user_id) VALUES (:userId)";
                $doctorStmt = $conn->prepare($doctorSql);

                $doctorStmt->bindParam(':userId', $createdUserId);

                $doctorStmt->execute();
            }





            if ($createdUserId) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: Unable to register user. Please try again.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle PDO exceptions
        }
    } else {
        // Passwords don't match, handle accordingly
        echo "Error: Passwords do not match. Please try again.";
    }
}
