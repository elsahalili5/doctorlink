<!DOCTYPE html>
<html lang="en">
<?php
require 'auth/is-privatepage.php';
require './database/config.php';

try {
    $stmt = $conn->query("SELECT * FROM Drugs");
    $stmt->execute();
    $drugs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e;
}
?>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
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
                <div class="container-fluid">
                    <h1>Drugs</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            Drugs Management Table
                        </div>
                        <div class="card-body">
                            <div class="add-new-drug mb-4">
                                <!-- Button trigger modal -->
                                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addDrugModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Add New Drug
                                </a>

                                <!-- Add Drug Modal -->
                                <div class="modal fade" id="addDrugModal" tabindex="-1" aria-labelledby="addDrugModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addDrugModalLabel">Add New Drug</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for adding a new drug -->
                                                <form id="addDrugForm" action="drugs-logic.php" method="POST"> <!-- Added method="POST" -->
                                                    <div class="mb-3">
                                                        <label for="drugName" class="form-label">Drug Name:</label>
                                                        <input type="text" class="form-control" id="drugName" name="drugName" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note:</label> <!-- New input field for the note -->
                                                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-secondary" name="submit">Save</button> <!-- Added name="submit" -->
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="drugTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Drug Name</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php if (isset($drugs) && !empty($drugs)) : ?>
                                        <?php foreach ($drugs as $drug) : ?>
                                            <tr>
                                                <td><?php echo $drug['id']; ?></td>
                                                <td><?php echo $drug['drug_name']; ?></td>
                                                <td><?php echo $drug['note']; ?></td>
                                                <td class="action-links">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#editDrugModal<?= $drug['id'] ?>">
                                                        <i class="fa-regular fa-pen-to-square" style="color: #000000;"></i>
                                                    </a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteDrugModal<?= $drug['id'] ?>">
                                                        <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                                    </a>
                                                </td>


                                                <div class="modal fade" id="editDrugModal<?= $drug['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Drug</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="edit-drug.php" method="post">
                                                                    <input type="hidden" name="drugId" value="<?= $drug['id'] ?>">
                                                                    <div class="mb-3">
                                                                        <label for="editDrugName" class="form-label">Drug Name:</label>
                                                                        <input type="text" class="form-control" id="editDrugName" name="editDrugName" value="<?= $drug['drug_name'] ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="note" class="form-label">Note:</label> <!-- New input field for the note -->
                                                                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn button">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for deleting drug -->
                                                <div class="modal fade" id="deleteDrugModal<?= $drug['id'] ?>" tabindex="-1" aria-labelledby="deleteDrugModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteDrugModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this drug?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <a href="delete-drug.php?id=<?= $drug['id'] ?>" class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td>drugs found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>

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