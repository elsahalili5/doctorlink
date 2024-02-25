<?php

session_start();

if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
    $isLoggedinUserDoctor = $loggedInUser && $loggedInUser['UserType'] === 'Doctor';
    $isLoggedinUserPatient = $loggedInUser
        && $loggedInUser['UserType'] === 'Patient';
    $isLoggedinUserAdmin = $loggedInUser && $loggedInUser['UserType'] === 'Admin';
}
