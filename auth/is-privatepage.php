<?php
session_start();
if (!$_SESSION['loggedIn']) {
    header("Location: loginsignin.php");
}
