<?php
require 'auth/is-privatepage.php';
require './database/config.php';
try {
    $stmt = $conn->prepare("
        SELECT a.*, CONCAT(u.Name, ' ', u.Surname) AS doctorName
        FROM Appointments a
        LEFT JOIN User u ON a.doctorId = u.Id
    ");
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e;
}

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
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Tables - SB Admin</title>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />

<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
</style>

<body class="sb-nav-fixed">
    <?php include('layout/navigation.php') ?>

    <div id="layoutSidenav">
        <?php include('layout/sidenav.php') ?>

        <div id="layoutSidenav_content" class="layoutsidenav_content">

            <main>
                <div class="container-fluid">
                    <h1>Appointments</h1>



                    <div class="card mb-4">
                        <div class="card-header">
                            Appointments Management Table
                        </div>
                        <div class="card-body">
                            <div class="add-new-drug mb-4">
                                <!-- Button trigger modal -->
                                <a href="appointment.php" class="btn btn-secondary">
                                    <i class="fa-solid fa-plus"></i>
                                    Add New Appointment
                                </a>
                                <!-- <div class="modal fade" id="addDrugModal" tabindex="-1" aria-labelledby="addDrugModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addDrugModalLabel">Add New Drug</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="addDrugForm" action="drugs-logic.php" method="POST">
                                                    <div class="mb-3">
                                                        <label for="tradeName" class="form-label">Trade Name:</label>
                                                        <input type="text" class="form-control" id="tradeName" name="tradeName" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="genericName" class="form-label">Generic Name:</label>
                                                        <input type="text" class="form-control" id="genericName" name="genericName" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note:</label>
                                                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn button" name="submit">Save</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <table id="appointmentTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Procedure</th>
                                        <th>Appt Date</th>
                                        <th>Booking Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($appointments as $appointment) : ?>
                                        <tr>
                                            <td><?php echo $appointment['doctorName']; ?></td>
                                            <td><?php echo $appointment['appointmentProcedure']; ?></td>
                                            <td><?php echo $appointment['preferredDate']; ?></td>
                                            <td><?php echo $appointment['created_at']; ?></td>
                                            <td><?php echo $appointment['preferredTime']; ?></td>
                                            <td class="action-links">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#editAppointmentModal<?= $appointment['id'] ?>">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #000000;"></i>
                                                </a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteAppointmentModal<?= $appointment['id'] ?>">
                                                    <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                                </a>
                                            </td>

                                            <div class="modal fade" id="editAppointmentModal<?= $appointment['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="edit-appt.php" method="post">
                                                                <input type="hidden" name="appointmentId" value="<?= $appointment['id'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="editDoctor" class="form-label">Doctor:</label>
                                                                    <select id="editDoctor" name="editDoctor" class="form-select" required>
                                                                        <?php foreach ($doctors as $doctor) : ?>
                                                                            <option value="<?= $doctor['Id'] ?>" <?= ($doctor['Id'] == $appointment['doctorId']) ? 'selected' : '' ?>>
                                                                                <?= $doctor['Name'] . ' ' . $doctor['Surname'] ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editProcedure" class="form-label">Procedure:</label>
                                                                    <input type="text" class="form-control" id="editProcedure" name="editProcedure" value="<?= $appointment['procedure'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editApptDate" class="form-label">Appointment Date:</label>
                                                                    <input type="date" class="form-control" id="editApptDate" name="editApptDate" value="<?= $appointment['appt_date'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editBookingDate" class="form-label">Booking Date:</label>
                                                                    <input type="date" class="form-control" id="editBookingDate" name="editBookingDate" value="<?= $appointment['booking_date'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editTime" class="form-label">Time:</label>
                                                                    <input type="time" class="form-control" id="editTime" name="editTime" value="<?= $appointment['time'] ?>" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal for deleting drug -->
                                            <div class="modal fade" id="deleteAppointmentModal<?= $appointment['id'] ?>" tabindex="-1" aria-labelledby="deleteAppointmentModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAppointmentModalLabel">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this appointment?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a href="delete-appt.php?id=<?= $appointment['id'] ?>" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </div>


    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>