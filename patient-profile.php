<?php
session_start();
require 'auth/is-privatepage.php';
require './database/config.php';
require 'auth/logged-in-user.php';


if ($loggedInUser) {
    $userId = $loggedInUser['Id'];

    try {
        $userId = $_SESSION['user']['Id'];
        $stmt = $conn->prepare("
            SELECT u.Name, u.Surname, p.*
            FROM User u 
            JOIN Patients p ON p.user_id = u.Id 
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



<form action="patient-profilelogic.php" method="POST">
    <input type="hidden" name="UserID" value="" />

    <div class="mb-3">
        <label for="firstName" class="form-label">First Name:</label>
        <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $user['Name']; ?>">
    </div>

    <div class="mb-3">
        <label for="lastName" class="form-label">Last Name:</label>
        <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $user['Surname']; ?>">
    </div>


    <div class="mb-3">
        <label for="dateOfBirth" class="form-label">Date of Birth:</label>
        <input type="date" id="dateOfBirth" name="dateOfBirth" class="form-control" value="<?php echo $user['date_of_birth']; ?>">
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender:</label>
        <select id="gender" name="gender" class="form-select">
            <option value="Male" <?php echo ($user['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($user['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($user['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address:</label>
        <input type="text" id="address" name="address" class="form-control" value="<?php echo $user['address']; ?>">
    </div>

    <div class="mb-3">
        <label for="contactNumber" class="form-label">Contact Number:</label>
        <input type="text" id="contactNumber" name="contactNumber" class="form-control" value="<?php echo $user['contact_number']; ?>">
    </div>

    <div class="mb-3">
        <label for="medicalHistory" class="form-label">Medical History:</label>
        <textarea id="medicalHistory" name="medicalHistory" class="form-control"><?php echo $user['medical_history']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="insuranceInfo" class="form-label">Insurance Info:</label>
        <input type="text" id="insuranceInfo" name="insuranceInfo" class="form-control" value="<?php echo $user['insurance_info']; ?>">
    </div>

    <button type="submit" class="btn button mt-3">Update Profile</button>
</form>