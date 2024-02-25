<!DOCTYPE html>
<html lang="en">
<?php
require 'auth/is-privatepage.php';
require './database/config.php';

try {
    $stmt = $conn->query("SELECT * FROM User");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<style>
    .action-links a {
        margin-right: 10px;
        text-decoration: none;
        color: #007bff;
    }

    .action-links a:hover {
        text-decoration: underline;
    }
</style>

<body class="sb-nav-fixed">
    <?php include('layout/navigation.php') ?>

    <div id="layoutSidenav">
        <?php include('layout/sidenav.php') ?>

        <div id="layoutSidenav_content" class="layoutsidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            Users Management Table
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>

                                    </tr>
                                    <div class="card mb-4" style="margin-top: 10px;">
                                        <div class="card-body">
                                            <!-- Button trigger modal -->
                                            <a href="add-user.php" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                                <i class="fa-solid fa-plus"></i>

                                                Add New User
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="add-userlogic.php" method="post">
                                                                <div class="mb-3">
                                                                    <label for="firstName" class="form-label">First Name:</label>
                                                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="lastName" class="form-label">Last Name:</label>
                                                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email:</label>
                                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Password:</label>
                                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="userType" class="form-label">User Type:</label>
                                                                    <select class="form-select" id="userType" name="userType" required>
                                                                        <option value="">Select User Type</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="user">Doctor</option>
                                                                        <option value="user">Patient</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-secondary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </thead>

                                <tbody>
                                    <?php if (isset($users) && !empty($users)) : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $user['Id'] ?></td>
                                                <td><?= $user['Name'] ?></td>
                                                <td><?= $user['Surname'] ?></td>
                                                <td><?= $user['Email'] ?></td>
                                                <td><?= $user['UserType'] ?></td>

                                                <td class="action-links">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['Id'] ?>">
                                                        <i class="fa-regular fa-pen-to-square" style="color: #000000;"></i>
                                                    </a>
                                                    <a href=" " data-bs-toggle="modal" data-bs-target="#deleteUserModal<?= $user['Id'] ?>">
                                                        <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                                    </a>
                                                </td>

                                                <div class="modal fade" id="editUserModal<?= $user['Id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form for editing user information -->
                                                                <form action="edit-user.php" method="post">
                                                                    <input type="hidden" name="userId" value="<?= $user['Id'] ?>">
                                                                    <div class="mb-3">
                                                                        <label for="editFirstName" class="form-label">First Name:</label>
                                                                        <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?= $user['Name'] ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editLastName" class="form-label">Last Name:</label>
                                                                        <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?= $user['Surname'] ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editEmail" class="form-label">Email:</label>
                                                                        <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?= $user['Email'] ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editRole" class="form-label">Role:</label>
                                                                        <select class="form-select" id="editRole" name="editRole" required>
                                                                            <option value="admin" <?= $user['UserType'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                                            <option value="user" <?= $user['UserType'] === 'user' ? 'selected' : '' ?>>Doctor</option>
                                                                            <option value="patient" <?= $user['UserType'] === 'patient' ? 'selected' : '' ?>>Patient</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal HTML -->
                                                <div class="modal fade" id="deleteUserModal<?= $user['Id'] ?>" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this user?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <a href="delete-user.php?id=<?= $user['Id'] ?>" class="btn btn-danger green">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td>No users found</td>
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