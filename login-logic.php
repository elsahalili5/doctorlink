
<?php
session_start();


require "./database/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];

    $sql = "SELECT * FROM User WHERE Email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>