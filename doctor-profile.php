<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';
require 'auth/logged-in-user.php';


if ($loggedInUser) {
    $userId = $loggedInUser['Id'];

    try {
        $userId = $loggedInUser['Id'];
        $stmt = $conn->prepare("
            SELECT u.Name, u.Surname, d.*
            FROM User u 
            JOIN Doctor d ON d.user_id = u.Id 
            WHERE u.Id = :userId
        ");

        $stmt->bindParam(":userId", $userId);
        $stmt->execute();

        $user = $stmt->fetch();
    } catch (PDOException $e) {
        echo $e;
    }
} else {
    echo "User is not logged in";
}
?>



<form action="doctor-profilelogic.php" method="POST">
    <input type="hidden" name="UserID" value="" />

    <div class="mb-3">
        <label for="FirstName" class="form-label">First Name:</label>
        <input type="text" id="FirstName" name="FirstName" class="form-control" value="<?php echo $user['Name']; ?>">
    </div>

    <div class="mb-3">
        <label for="LastName" class="form-label">Last Name:</label>
        <input type="text" id="LastName" name="LastName" class="form-control" value="<?php echo $user['Surname']; ?>">
    </div>


    <div class="mb-3">
        <label for="Speciality" class="form-label">Speciality:</label>
        <input type="text" id="Speciality" name="Speciality" class="form-control" value="<?php echo $user['speciality']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="ClinicAddress" class="form-label">ClinicAddress:</label>
        <input type="text" id="ClinicAddress" name="ClinicAddress" class="form-control" value="<?php echo $user['clinic_address']; ?>" required>

    </div>

    <div class="mb-3">
        <label for="ContactNumber" class="form-label">Contact Number:</label>
        <input id="ContactNumber" type="number" name="ContactNumber" class="form-control" value="<?php echo $user['contact_number']; ?>" required>
    </div>



    <button type="submit" class="btn button mt-3">Update Profile
    </button>
</form>