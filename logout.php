<?php
session_start();

session_destroy();
header('Location: ./informing-page/carousel/home.php');
