<?php
require './database/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["appointmentId"], $_POST["editDoctor"], $_POST["editProcedure"], $_POST["editApptDate"], $_POST["editBookingDate"], $_POST["editTime"])) {
    $appointmentId = $_POST["appointmentId"];
    $doctor = $_POST["editDoctor"];
    $procedure = $_POST["editProcedure"];
    $apptDate = $_POST["editApptDate"];
    $bookingDate = $_POST["editBookingDate"];
    $apptTime = $_POST["editTime"];

    try {
        $sql = "UPDATE Appointments SET doctorId = :doctor, appointmentProcedure = :procedure, preferredDate = :apptDate, created_at = :bookingDate, preferredTime = :apptTime WHERE id = :appointmentId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":appointmentId", $appointmentId);
        $stmt->bindParam(":doctor", $doctor);
        $stmt->bindParam(":procedure", $procedure);
        $stmt->bindParam(":apptDate", $apptDate);
        $stmt->bindParam(":bookingDate", $bookingDate);
        $stmt->bindParam(":apptTime", $apptTime);
        $stmt->execute();
        header("Location: view-appointmentss.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: view-appointments.php");
    exit();
}
