<?php session_start(); ?>
<?php require 'auth/is-privatepage.php';
require 'auth/logged-in-user.php';
require './database/config.php';

try {
    $stmt = $conn->prepare("
        SELECT Id, Name, Surname
        FROM User
        WHERE UserType = 'Doctor'
    ");
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />

    <link href="css/appointment-form.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('layout/navigation.php') ?>

    <div id="layoutSidenav">
        <?php include('layout/sidenav.php') ?>

        <div id="layoutSidenav_content" class="layoutsidenav_content">
            <main>
                <style>
                    h2 {
                        text-align: center;
                    }

                    p {
                        text-align: center;
                        margin-bottom: 35px;
                    }

                    label {
                        display: block;
                        margin-bottom: 5px;
                    }

                    input[type="text"],
                    input[type="email"],
                    input[type="number"],
                    select {
                        width: 100%;
                        padding: 8px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-sizing: border-box;
                    }


                    .appointment-form-wrapper {
                        /* border-radius: 50px; */
                        margin: 100px auto;
                        /* padding: 80px; */
                        /* width: 60%; */
                        /* border: 1px solid #012f33; */
                    }

                    .input-group {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 10px;
                    }

                    .input-group>div {
                        flex: 1;
                        margin-right: 10px;
                    }

                    .input-group {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 20px;
                    }

                    .input-group>div {
                        flex: 1;
                        margin-right: 20px;
                    }

                    .input-group>div:last-child {
                        margin-right: 0;
                    }

                    label {
                        display: block;
                        margin-bottom: 5px;
                        font-weight: bold;
                    }

                    input[type="date"],
                    input[type="time"],
                    select {
                        width: 100%;
                        padding: 8px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 16px;
                    }

                    input[type="date"]:focus,
                    input[type="time"]:focus,
                    select:focus {
                        outline: none;
                        border-color: #007bff;
                    }

                    .submit-button-container {
                        text-align: center;
                    }

                    .submit-button-container input {
                        margin-top: 20px;


                    }
                </style>
                </head>

                <body>
                    <div class="appointment-form-wrapper">
                        <h2>Doctor Appointment Request Form</h2>
                        <p>Fill the form below and we will get back soon to you for more updates and plan your appointment.</p>
                        <form action="appointment-logic.php" method="post">
                            <div class="input-group">
                                <div>
                                    <label for="firstName">First Name:</label>
                                    <input type="text" id="firstName" name="firstName" required>
                                </div>
                                <div>
                                    <label for="lastName">Last Name:</label>
                                    <input type="text" id="lastName" name="lastName" required>
                                </div>
                            </div>

                            <div class="input-group">
                                <div>
                                    <label for="dob">Date of Birth:</label>
                                    <input type="date" id="dob" name="dob" required>
                                </div>
                                <div>
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="number" id="phoneNumber" name="phoneNumber" required>
                                    <!-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" -->
                                </div>
                            </div>

                            <div class="input-group">

                                <div>
                                    <label for="address">Address:</label>
                                    <input type="text" id="address" name="address" required>
                                </div>
                                <div>
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="input-group">

                                <div>
                                    <label for="previousVisit">Have you visited our facility before?</label>
                                    <select id="previousVisit" name="previousVisit" required>
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="doctor">Choose a doctor:</label>
                                    <select id="doctor" name="doctor" required>
                                        <?php
                                        foreach ($doctors as $doctor) {
                                            echo "<option value='" . $doctor['Id'] . "'>" . $doctor['Name'] . " " . $doctor['Surname'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <div>
                                    <label for="appointmentProcedure">Appointment Procedure:</label>
                                    <input type="text" id="appointmentProcedure" name="appointmentProcedure" required>
                                </div>
                                <div>
                                    <label for="preferredDate">Preferred Appointment Date:</label>
                                    <input type="date" id="preferredDate" name="preferredDate" required>
                                </div>
                                <div>
                                    <label for="preferredTime">Preferred Appointment Time:</label>
                                    <input type="time" id="preferredTime" name="preferredTime" required>
                                </div>
                            </div>


                            <div class="submit-button-container">
                                <input type="submit" class=" btn btn-secondary" value="Save">
                            </div>

                        </form>
                    </div>
                </body>

</html>

</main>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>