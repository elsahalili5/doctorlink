<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';


try {
    $stmt = $conn->prepare("
        SELECT p.id, p.user_id, u.Name, u.Surname
        FROM Patients p
        JOIN User u ON p.user_id = u.Id;
    ");

    $stmt->execute();
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e;
}

try {
    $stmt = $conn->prepare("
        SELECT * FROM Drugs
    ");
    $stmt->execute();
    $drugs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('layout/navigation.php') ?>

    <div id="layoutSidenav">
        <?php include('layout/sidenav.php') ?>

        <div id="layoutSidenav_content" class="layoutsidenav_content">
            <main>
                <div class="px-4">
                    <form id="prescriptionForm" method="POST" action="create-prescription-logic.php">
                        <div class="container">
                            <h1 class="mt-4">Add new prescription</h1>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="patientSelect" class="form-label">Select Patient:</label>
                                            <select id="patientSelect" name="patientID" class="form-select">
                                                <?php
                                                foreach ($patients as $patient) {
                                                    echo "<option value='" . $patient['id'] . "'>" . $patient['Name'] . " " . $patient['Surname'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            </select>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-secondary mt-2">Save</button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="drugs-list-container overflow-auto" id="drugs-list" style="max-height: 500px;">
                                            <div class="drug-entry mb-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5>Drug 1</h3>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="drugType" class="form-label">Type:</label>
                                                            <input type="text" name="drugType[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="drugId" class="form-label">Drug:</label>
                                                            <select name="drugId[]" class="form-select">
                                                                <?php
                                                                foreach ($drugs as $drug) {
                                                                    echo "<option value='" . $drug['id'] . "'>" . $drug['drug_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="mgMl" class="form-label">mg/ml:</label>
                                                            <input type="number" name="mgMl[]" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="mb-3">
                                                            <label for="dose" class="form-label">Dose:</label>
                                                            <input type="number" name="dose[]" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="duration" class="form-label">Duration:</label>
                                                            <input type="text" name="duration[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="advice" class="form-label">Advice/Comment:</label>
                                                            <textarea id="advice" name="advice[]" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" onclick="addDrug()" class="btn btn-outline-secondary mt-2 mb-5">
                                                <i class="fas fa-plus"></i> Add Drug
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-r8mnRftJI5U6c9fFf7EtYTqqbwTAZfWSi+ucV7+gQDIvTn2jUZz+/zGLaxCIbj3B" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        function addDrug() {

            // Clone the drug entry fields
            var drugEntry = document.querySelector('.drug-entry').cloneNode(true);
            // Clear the input values
            var inputs = drugEntry.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.value = '';
            });
            document.querySelector('#drugs-list').appendChild(drugEntry);
        }
    </script>
</body>

</html>