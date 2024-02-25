<?php
include('./database/config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($userType)) {
        try {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO User (Name, Surname, Username, Password, Email, UserType) VALUES (:firstName, :lastName, :email, :password, :email, :userType)";

            $insertSql = $conn->prepare($sql);

            $insertSql->bindParam(':firstName', $firstName);
            $insertSql->bindParam(':lastName', $lastName);
            $insertSql->bindParam(':email', $email);
            $insertSql->bindParam(':password', $hashedPassword);
            $insertSql->bindParam(':userType', $userType);

            $insertSql->execute();

            header("Location: users.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
}
