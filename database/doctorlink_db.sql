-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2024 at 11:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointments`
--

CREATE TABLE `Appointments` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `previousVisit` enum('yes','no') NOT NULL,
  `doctorId` int(11) NOT NULL,
  `appointmentProcedure` varchar(50) NOT NULL,
  `preferredDate` date NOT NULL,
  `preferredTime` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Appointments`
--

INSERT INTO `Appointments` (`id`, `firstName`, `lastName`, `dob`, `phoneNumber`, `address`, `email`, `previousVisit`, `doctorId`, `appointmentProcedure`, `preferredDate`, `preferredTime`, `created_at`) VALUES
(5, 'elsa', 'halili', '2006-07-31', '048171245', 'Lladofc', 'elsahalilii5@gmail.com', 'no', 11, 'treatment', '2006-05-06', '18:49:00', '2006-05-05 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `clinic_address` varchar(100) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`id`, `user_id`, `speciality`, `clinic_address`, `contact_number`) VALUES
(1, 11, 'rqwr', 'qwr', 'rewer');

-- --------------------------------------------------------

--
-- Table structure for table `Drugs`
--

CREATE TABLE `Drugs` (
  `id` int(11) NOT NULL,
  `drug_name` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Drugs`
--

INSERT INTO `Drugs` (`id`, `drug_name`, `note`) VALUES
(5, 'ibuprofen', 'sorethroats'),
(6, 'paracetamol', 'painkiller'),
(7, 'diclofenac', 'treats aches'),
(8, 'aspirin', 'aches');

-- --------------------------------------------------------

--
-- Table structure for table `Patients`
--

CREATE TABLE `Patients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `insurance_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Patients`
--

INSERT INTO `Patients` (`id`, `user_id`, `date_of_birth`, `gender`, `address`, `contact_number`, `medical_history`, `insurance_info`) VALUES
(3, 12, '2019-02-25', 'Male', 'Poduejve', '', '', ''),
(4, 13, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Prescriptions`
--

CREATE TABLE `Prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `prescription_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Prescriptions`
--

INSERT INTO `Prescriptions` (`id`, `patient_id`, `prescription_date`) VALUES
(21, 3, '2024-02-25 11:11:00'),
(22, 4, '2024-02-25 11:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `Prescription_drugs`
--

CREATE TABLE `Prescription_drugs` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `drug_id` int(11) DEFAULT NULL,
  `drugType` varchar(50) DEFAULT NULL,
  `mg_ml` int(55) NOT NULL,
  `dose` int(30) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `advice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Prescription_drugs`
--

INSERT INTO `Prescription_drugs` (`id`, `prescription_id`, `drug_id`, `drugType`, `mg_ml`, `dose`, `duration`, `advice`) VALUES
(1, 21, 5, 'test', 1, 11, 'weiufgewuygfuyew', 'weufhweuhfiuewhfiwe'),
(2, 22, 5, 'type 1', 1, 1, '1', '1'),
(3, 22, 7, 'type 2', 2, 2, '2', '1'),
(4, 22, 5, 'type 4', 342, 23, '232', '1wefwejhfewi'),
(5, 22, 5, 'test 3', 1, 1, '1', 'ewfwef1');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `UserType` enum('Patient','Doctor','Admin','User') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `Name`, `Surname`, `Username`, `Password`, `Email`, `UserType`) VALUES
(1, 'Dr.Elsa', 'Halili', 'elsahalili@gmail.com', '$2y$10$xCpGqSzN57znELBB/whXce7OvW2QHFRFuyeYQoABQCwC.ykRsrbEa', 'elsahalili1@gmail.com', 'Doctor'),
(9, 'Patient1', 'Patient1', 'patient1@gmail.com', '$2y$10$kstAfmWFVIJOB/GsHRlVuOxnOSUZC7fMik50olZw2OUQjkKAii6EG', 'patient1@gmail.com', 'Patient'),
(10, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$w7iN8aSuSzfSqxDEsNXQvOG6zqn6B0ROadCZRnDc/7agSDVjlUJ7C', 'admin@gmail.com', 'Admin'),
(11, 'Doctor2', 'Doctor2', 'doctor@gmail.com', '$2y$10$dkDtBUpsBGbXp/UQe4WKhexM2.0eQfr.VQ7.ADkd/7CkwTjvy/kXi', 'doctor@gmail.com', 'Doctor'),
(12, 'John', 'Doe', 'john@test.com', '$2y$10$LXRogv.B/uYTe9pabUpvgeYTFKPlyd1Hi4CumVpwIDFuXXhCmPHgO', 'john@test.com', 'Patient'),
(13, 'Lorem', 'Ipsum', 'lorem@test.com', '$2y$10$pDlz8oHnoSeSnZnBXddr..2WbA4BSURKnE3aKVrBgMnwLv4sZXO56', 'lorem@test.com', 'Patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointments`
--
ALTER TABLE `Appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UserID` (`user_id`);

--
-- Indexes for table `Drugs`
--
ALTER TABLE `Drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Patients`
--
ALTER TABLE `Patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`user_id`);

--
-- Indexes for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_patient_fk_1` (`patient_id`);

--
-- Indexes for table `Prescription_drugs`
--
ALTER TABLE `Prescription_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_list_prescriptions_ibfk_1` (`prescription_id`),
  ADD KEY `prescriptions_list_drug_ibfk_1` (`drug_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Drugs`
--
ALTER TABLE `Drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Patients`
--
ALTER TABLE `Patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Prescription_drugs`
--
ALTER TABLE `Prescription_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Patients`
--
ALTER TABLE `Patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`);

--
-- Constraints for table `Prescriptions`
--
ALTER TABLE `Prescriptions`
  ADD CONSTRAINT `prescriptions_patient_fk_1` FOREIGN KEY (`patient_id`) REFERENCES `Patients` (`Id`);

--
-- Constraints for table `Prescription_drugs`
--
ALTER TABLE `Prescription_drugs`
  ADD CONSTRAINT `prescriptions_list_drug_ibfk_1` FOREIGN KEY (`drug_id`) REFERENCES `Drugs` (`id`),
  ADD CONSTRAINT `prescriptions_list_prescriptions_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `Prescriptions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
