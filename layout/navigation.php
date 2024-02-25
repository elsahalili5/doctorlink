<?php
session_start();
require 'auth/logged-in-user.php';
?>

<link href="css/main.css" rel="stylesheet" />

<nav class="sb-topnav navbar navbar-expand navbar-dark navigation">
    <!-- Navbar Brand-->
    <a class="navbar-brand" href="#">
        <img class="logo" src="logo2.png" alt="DocLink Logo">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn search-btn" id="btnNavbarSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form> -->
    <!-- Navbar-->
    <div class="ms-auto">
        <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <p class="mb-0 mx-2"><?php echo $loggedInUser['Email'];  ?></p>

                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <?php if (isset($_SESSION['loggedIn'])) : ?>
                        <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                    <?php endif; ?>

                </ul>
            </li>
        </ul>
    </div>
</nav>