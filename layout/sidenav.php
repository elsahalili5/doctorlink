<?php
require "auth/logged-in-user.php";
?>

<link href="css/main.css" rel="stylesheet" />


<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark navigation" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                <?php if (!isset($_SESSION['loggedIn'])) : ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.php">Login</a>
                            <a class="nav-link" href="register.php">Register</a>
                            <a class="nav-link" href="password.php">Forgot Password</a>
                        </nav>
                    </div>
                <?php endif; ?>
                <?php if ($isLoggedinUserAdmin) : ?>



                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#userManagementCollapse" aria-expanded="false" aria-controls="userManagementCollapse">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        User Management
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>


                    <div class="collapse" id="userManagementCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="users.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                                View Users
                            </a>
                        </nav>
                    </div>
                <?php endif; ?>

                <?php if ($isLoggedinUserPatient) : ?>


                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#appointmentsCollapse" aria-expanded="false" aria-controls="appointmentsCollapse">
                        <div class="sb-nav-link-icon">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        Appointments
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>

                    <div class="collapse" id="appointmentsCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="appointment.php">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>
                                Book Appointment
                            </a>
                            <a class="nav-link" href="view-appointmentss.php">
                                <div class="sb-nav-link-icon"> <i class="fa-regular fa-eye"></i>
                                </div>
                                View Appointments
                            </a>
                        </nav>
                    </div>

                <?php endif; ?>
                <?php if ($isLoggedinUserDoctor) : ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#prescriptionsCollapse" aria-expanded="false" aria-controls="appointmentsCollapse">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-stethoscope"></i>

                        </div>
                        Prescriptions
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>

                    <div class="collapse" id="prescriptionsCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="prescriptions.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-prescription-bottle"></i>
                                </div>
                                Prescriptions

                            </a>
                            <a class="nav-link" href="drugs.php">
                                <div class="sb-nav-link-icon"> <i class="fa-solid fa-pills"></i>
                                </div>
                                Drugs
                            </a>
                        </nav>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div>
                <?php include('layout/footer.php'); ?>
            </div>
        </div>
    </nav>
</div>